@extends('layout.app')

@section('content')
    <qr-component></qr-component>
@endsection

@section('before-js')
    <script> window.config = window.config || {}; config.lang="{{app()->getLocale()}}";config.langs={!! json_encode(trans('js') ) !!};config.qrRenderUrl = "{{ route('qr.render')}}"; config.getCountries="{{ route('common.countries')}}";config.getStates="{{ route('common.states')}}";config.getCities="{{ route('common.cities')}}"; config.appId='#app';</script>
@endsection