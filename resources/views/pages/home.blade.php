@extends('layouts.generic')

@section('page_description', getSetting('site.description'))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' . getSetting('site.slogan'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@section('scripts')
    <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "{{getSetting('site.name')}}",
    "url": "{{getSetting('site.app_url')}}",
    "address": ""
  }
</script>
@stop

@section('styles')
    {!!
        Minify::stylesheet([
            '/css/pages/home.css',
            '/css/pages/search.css',
         ])->withFullUrl()
    !!}
@stop

@section('content')

    <div class="home-header min-vh-75 relative pt-2 home" >
        <div class="container h-100">
            <div class="row d-flex flex-row align-items-center h-100 justify-content-between">
                <div class="col-12 col-md-5 mt-4 mt-md-0 order-md-1 order-2">
                    <h1 class="font-weight-bold h2">{{__('Join us on xclusive')}}</h1>
                    <p class="font-weight-bold mt-3">{{__("Start your go solution")}}</p>
                    <div class="mt-4">
                        @auth
                            <a href="/feed" class="btn btn-grow bg-gradient-primary btn-round mb-0 me-1 mt-2 mt-md-0 mr-1 ml-1">{{ __("Fil d'actualité") }}</a>
                            <script type="text/javascript">
                                window.location.href = "/feed";
                            </script>
                        @endauth

                        @guest
                            <a href="{{ route('register') }}" class="btn btn-grow bg-gradient-primary btn-round mb-0 me-1 mt-2 mt-md-0 mr-1 ml-1">{{ __('Inscription') }}</a>
                            <a href="{{ route('login') }}" class="btn btn-grow bg-white btn-round mb-0 me-1 mt-2 mt-md-0 text-dark mr-1 ml-1">{{ __('Connexion') }}</a>
                        @endguest
                    </div>
                </div>
                <div class="col-12 col-md-6 p-md-5 pt-5 pt-md-5 order-md-2 order-1">
                    <div class="position-relative">
                         <img src="{{asset('/img/25853.jpg')}}" class="home-mid-img mb-5 mb-md-0" alt="{{__('Make more money')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <div class="my-5 py-5 home-bg-section home home_is_mobile_js">
        <div class="container my-5">
            <div class="row">
                <div class="col-12 col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('/img/home-scene-4.svg')}}" class="img-fluid home-box-img" alt="{{__('Premium & Private content')}}">
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="col-12 col-md-10 text-center">
                            <h5 class="text-bold">{{__('Premium & Private content')}}</h5>
                            <span>{{__('Enjoy high quality content, made for you and the ones like you.')}} </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('/img/home-scene-2.svg')}}" class="img-fluid home-box-img" alt="{{__('Private chat & Tips')}}">
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="col-12 col-md-10 text-center">
                            <h5 class="text-bold">{{__('Private chat & Tips')}}</h5>
                            <span>{{__('Enjoy private conversations and get tipped for your content.')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('/img/home-scene-3.svg')}}" class="img-fluid home-box-img" alt="{{__('Secured assets & Privacy focus')}}">
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="col-12 col-md-10 text-center">
                            <h5 class="text-bold">{{__('Secured assets & Privacy focus')}}</h5>
                            <span>{{__("Your content get's safely upload in the cloud and full controll to your account.")}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5 pb-3 pt-5 home mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <img src="{{asset('/img/2967.jpg')}}" class="home-mid-img mb-5 mb-md-0" alt="{{__('Make more money')}}">
                </div>
                <div class="col-12 col-md-6">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <div class="pl-4 pl-md-5">
                            <h2 class="font-weight-bold m-0">{{__('JoinXnow')}}</h2>
                            <div class="my-4 col-9 px-0">
                                <p>{{__("JoinXnowp")}}</p>
                            </div>
                            <div>
                                <a href="{{Auth::check() ? route('my.settings',['type'=>'verify']) : route('login') }}" class="btn bg-gradient-primary btn-grow btn-round mb-0 me-1 mt-2 mt-md-0 p-3">{{__('Become a creator')}}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<style>
    @media screen and (max-width: 992px){
        a.nav-link.btn.btn-primary.mr-2 {
            margin-top: 2rem;
            margin-right: 0 !important;
        }
    }
</style>
@stop
