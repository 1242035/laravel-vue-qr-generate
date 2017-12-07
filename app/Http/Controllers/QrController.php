<?php

namespace App\Http\Controllers;

class QrController extends Controller
{
    public function doRender()
    {
        $params = request()->all();

        $rules  = [
            'email' => ['required','email'],
            'info.full_name'    => ['required','min:3'],
            'info.mobile'       => ['required'],
            'info.street'       => ['required'],
            //'info.city_code'    => ['required'],
            //'info.state_code'   => ['required'],
            'info.country_code' => ['required'],
            //'info.size'         => ['required','between:780,1920'],
        ];

        $messages = [
            'email.required' => trans('validation.required',['attribute' => trans('js.email.title')]),
            'email.email' => trans('validation.email',['attribute' => trans('js.email.title')]),
            'info.full_name.required' => trans('validation.required',['attribute' => trans('js.full_name.title')]),
            'info.full_name.min' => trans('validation.min.string',['attribute' => trans('js.full_name.title'),'min' => 3]),
            'info.mobile.required' => trans('validation.required',['attribute' => trans('js.mobile.title')]),
            'info.street.required' => trans('validation.required',['attribute' => trans('js.address.street_title')]),
            'info.country_code.required' => trans('validation.required',['attribute' => trans('js.address.country_title')]),
            'info.size.required' => trans('validation.required',['attribute' => trans('js.size.title')]),
            'info.size.between' => trans('validation.between.numeric',['attribute' => trans('js.size.title'),'min' => 780, 'max' => 1920]),
        ];

        $validator = \Validator::make($params, $rules, $messages);

        if( $validator->passes() )
        {
            $user = \App\Models\User::firstOrCreate([
                'email' => $params['email']
            ]);
            $params['info']['user_id'] = $user->id;
            //$params['info']['file']    = $fileName;
            
            $qr = \App\Models\Qr::create($params['info']);
            

            $content = route('qr.detail',['id' => $qr->id]) . PHP_EOL. PHP_EOL ;
            
            if( isset( $params['info']['full_name']))
            {
                $content .= trans('js.full_name.title').': '.$params['info']['full_name']. PHP_EOL. PHP_EOL;
            }

            if( isset( $params['info']['mobile']))
            {
                $content .= trans('js.mobile.title').': '. $params['info']['mobile']. PHP_EOL. PHP_EOL;
            }
            
            $content .= trans('js.address.title').': ';

            if( isset( $params['info']['street']))
            {
                $content .= $params['info']['street']. ', ';
            }

            if( isset( $params['info']['city_code']))
            {
                $cityName = get_city_name_by_code($params['info']['city_code']);
                if( isset( $cityName ) )
                {
                    $content .= $cityName. ', ';
                }
            }
            if( isset( $params['info']['state_code']))
            {
                $stateName = get_state_name_by_code($params['info']['state_code']);
                if( isset( $stateName ) )
                {
                    $content .= $stateName. ', ';
                }
            }
            
            if( isset( $params['info']['country_code']))
            {
                $countryName = get_country_name_by_code( $params['info']['country_code'] );
                if( isset( $countryName ) )
                {
                    $content .= $countryName;
                }
            }

            $content = trim(rtrim($content,','));

            //return response()->json($content);
            $size = (int)$params['info']['size'];

            $encodeContent = \App\Extra\Qr::encode($content, $size);

            $fileName = date('/Y/m/d/').md5(microtime(true)).'.png';
            
            \Storage::disk('qr')->put($fileName, $encodeContent);

            $qr->file = $fileName;
            $qr->save();

            $countryName = get_country_name_by_code($qr->country_code);
            $stateName   = get_state_name_by_code($qr->state_code);
            $cityName    = get_city_name_by_code($qr->city_code);

            $qr->countryName = $countryName;
            $qr->stateName   = $stateName;
            $qr->cityName    = $cityName;
            $url = config('filesystems.disks.qr.url');

            \Mail::to( $params['email'] )->send(new \App\Mail\SendQr($qr) );

            if( request()->ajax() )
            {
                $response = new \stdClass;
                $response->error = 0;
                $response->url = $url;
                $response->qr  =  $qr;
                //$response->content = $content;
                $response->message = 'Chúng tôi đã gửi 1 mã QR tới '. $params['email'];
                return response()->json($response);
            }
        }

        if( request()->ajax() )
        {
            $response = new \stdClass;
            $response->error = -1;
            $response->message = $validator->messages()->first();

            return response()->json($response);
        }
        return back();
    }

    public function detail($id)
    {
        $qr = \App\Models\Qr::findOrFail($id);
        $qr->user()->update(['verified_fields'=>1]);
        return view('qr.detail',['qr' => $qr]);
    }
}
