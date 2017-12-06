<?php 
    $countryName = get_country_name_by_code($qr->country_code);
    $stateName   = get_state_name_by_code($qr->state_code);
    $cityName    = get_city_name_by_code($qr->city_code);
?>
<div style="width:100%:">
    
    <div style="width:40%;float:left;">
        <a href="{{ route('qr.detail',['id' => $qr->id])}}">
            <figure>
                <img style="width:100%;" src="{{ $message->embed( public_path('/'. config('filesystems.disks.qr.dir') .$qr->file) ) }}">
                
                <figcaption style="width:100%;display:block;text-align:center;">
                    <a href="{{ asset( config('filesystems.disks.qr.dir') . $qr->file ) }}">Fullsize</a>
                </figcaption>
            </figure>
        </a>
    </div>
    <div style="width:50%;float:left;padding-top:50px;">
        <p>{{ trans('js.full_name.title') }}: {{$qr->full_name}}</p>
        <p>{{ trans('js.mobile.title') }}: {{$qr->mobile}}</p>
        <p>{{ trans('js.address.title') }}: {{$qr->street}}{{$cityName ? ', '.$cityName: ''}}{{$stateName ? ', '.$stateName : ''}}{{$countryName ? ', '.$countryName : ''}}</p>
        <p>{{ trans('js.size.title') }}: {{$qr->size}}</p>
    </div>
</div>
