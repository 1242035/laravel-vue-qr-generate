<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use stdClass;

class CommonController extends Controller
{
    public function getCountries()
    {
        $params = request()->all();

        $query = Country::query();

        $countries =  $query->get();

        if( request()->ajax() )
        {
            $response = new stdClass;
            $response->error = 0;
            $response->params = $params;
            $response->countries = $countries;

            return response()->json( $response );
        }

        return back();

    }

    public function getStates()
    {
        $params = request()->all();

        $query = State::query();

        if( isset( $params['country_code'] ) )
        {
            $query->country($params['country_code']);
        }

        $states =  $query->get();

        if( request()->ajax() )
        {
            $response = new stdClass;
            $response->error = 0;
            $response->params = $params;
            $response->states = $states;

            return response()->json( $response );
        }

        return back();

    }

    public function getCities()
    {
        $params = request()->all();

        $query = City::query();

        if( isset( $params['country_code'] ) )
        {
            $query->country($params['country_code']);
        }

        if( isset( $params['state_code'] ) )
        {
            $query->state($params['state_code']);
        }

        $cities =  $query->get();

        if( request()->ajax() )
        {
            $response = new stdClass;
            $response->error = 0;
            $response->params = $params;
            $response->cities = $cities;

            return response()->json( $response );
        }

        return back();

    }
}
