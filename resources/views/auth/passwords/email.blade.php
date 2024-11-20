@extends('layouts.no-nav')
@section('meta')
    <meta name="robots" content="noindex">
@stop

@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="col-md-12">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-xl-4 mx-auto">
                            <a href="{{action('HomeController@index')}}">
                                <img class="brand-logo pb-4" src="{{asset( (Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? getSetting('site.dark_logo') : getSetting('site.light_logo')) : (Cookie::get('app_theme') == 'dark' ? getSetting('site.dark_logo') : getSetting('site.light_logo'))) )}}">
                            </a>
                            @if (session('status'))
                                <div class="alert alert-success text-white" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @include('auth.passwords.email-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
@endsection
