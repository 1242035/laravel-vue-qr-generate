<?php

if( ! function_exists('get_country_name_by_code') )
{
    function get_country_name_by_code($countryCode)
    {
        $country = \App\Models\Country::where('iso_a2', $countryCode)->first();
        return isset( $country->name ) && ! empty( $country->name ) ? $country->name : null;
    }
}

if( ! function_exists('get_state_name_by_code') )
{
    function get_state_name_by_code($stateCode)
    {
        $state = \App\Models\State::where('iso', $stateCode)->first();
        return isset( $state->name ) && ! empty( $state->name ) ? $state->name : null;
    }
}

if( ! function_exists('get_city_name_by_code') )
{
    function get_city_name_by_code($cityCode)
    {
        $city = \App\Models\City::where('code', $cityCode)->first();
        return isset( $city->name ) && ! empty( $city->name ) ? $city->name : null;
    }
}