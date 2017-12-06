@extends('layout.app')

<?php 
    $countryName = get_country_name_by_code($qr->country_code);
    $stateName   = get_state_name_by_code($qr->state_code);
    $cityName    = get_city_name_by_code($qr->city_code);
?>

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Thông tin chi tiết</div>
            <div class="panel-body">
                <p>{{ trans('js.full_name.title') }}: {{$qr->full_name}}</p>
                <p>{{ trans('js.mobile.title') }}: {{$qr->mobile}}</p>
                <p>{{ trans('js.address.title') }}: {{$qr->street}}{{$cityName ? ', '.$cityName: ''}}{{$stateName ? ', '.$stateName : ''}}{{$countryName ? ', '.$countryName : ''}}</p>
                <p>{{ trans('js.size.title') }}: {{$qr->size}}</p>
            </div>
        </div>
    </div>
@endsection
