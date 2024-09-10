<meta charset="utf-8">

{{-- Page title --}}
@hasSection('page_title')
<title>@yield('page_title') - {{getSetting('site.name')}} </title>
@else
<title>{{getSetting('site.name')}} - {{getSetting('site.slogan')}}</title>
@endif

{{-- Generic Meta tags --}}
@hasSection('page_description')
<meta name="description" content="@yield('page_description')">
@endif

{{-- Mobile tab color --}}
<meta name="theme-color" content="#505050">
<meta name="color-scheme" content="dark light">

{{-- Facebook share section --}}
<meta property="og:url" content="@yield('share_url')" />
<meta property="og:type" content="@yield('share_type')" />
<meta property="og:title" content="@yield('share_title')" />
<meta property="og:description" content="@yield('share_description')" />
<meta property="og:image" content="@yield('share_img')" />

<meta name="csrf-token" content="{{ csrf_token() }}">


{{-- Twitter share section --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@yield('share_url')">
<meta name="twitter:creator" content="@yield('author')">
<meta name="twitter:title" content="@yield('share_title')">
<meta name="twitter:description" content="@yield('share_description')">
<meta name="twitter:image" content="@yield('share_img')">

{{-- CSRF Baby --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
@yield('meta')

@if(getSetting('site.allow_pwa_installs'))
@laravelPWA
<script type="text/javascript">
    (function () {
        // Initialize the service worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('{{rtrim(getSetting('
                site.app_url '),' / ')}}' + '/serviceworker.js', {
                    scope: '.'
                }).then(function (registration) {
                // Registration was successful
                // eslint-disable-next-line no-console
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration
                    .scope);
            }, function (err) {
                // registration failed :(
                // eslint-disable-next-line no-console
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }
    })();
</script>
@endif
<script src="{{asset('libs/pusher-js/dist/web/pusher.min.js')}}"></script>

{{-- Favicon --}}
<link rel="shortcut icon" href="{{ getSetting('site.favicon') }}" type="image/x-icon">

{{-- (Preloading) Fonts --}}
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300" rel="preload" as="style">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,500,600,700"
    rel="preload" as="style">
{{-- Global CSS Assets --}}
{!!
Minify::stylesheet(
array_merge([
'/libs/cookieconsent/build/cookieconsent.min.css',
'/css/theme/bootstrap'.
(Cookie::get('app_rtl') == null ? (getSetting('site.default_site_direction') == 'rtl' ? '.rtl' : '') :
(Cookie::get('app_rtl') == 'rtl' ? '.rtl' : '')).
(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? '.dark' : '') :
(Cookie::get('app_theme') == 'dark' ? '.dark' : '')).
'.css',
'/css/app.css',
],
(isset($additionalCss) ? $additionalCss : [])
))->withFullUrl()
!!}

{{-- Page specific CSS --}}
@yield('styles')

@if(getSetting('custom-code-ads.custom_css'))
<style>
    {
         ! ! getSetting('custom-code-ads.custom_css') ! !
    }
</style>
@endif


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
<style>
    body,
    html {
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
    }

    .navbar-brand img {
        max-width: max-content;
        max-height: 34px;
    }

    @media (min-width: 1200px) {

        .home .container,
        .home .container-lg,
        .home .container-md,
        .home .container-sm,
        .home .container-xl,
        footer.py-5 .container {
            max-width: 1060px;
        }
    }

    footer .text-link,
    footer a {
        color: #fff !important;
        ;
    }

    .brand-logo {
        width: 200px;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }

    .side-menu .user-avatar,
    .sidebar .user-avatar {
        width: 34px;
        height: 34px;
    }

    .neutral-bg {
        background-color: #060a0f !important;
    }

    .login .col-lg-4.col-xl-4.mx-auto {
        max-width: 380px;
    }

    .profile-cover-bg {
        background-color: transparent;
    }

    .user-side-menu .nav-item .side-menu-label {

        font-weight: 500;
    }

    .icon-large {
        font-size: 22px;
    }

    .col-12.col-md-8 h3,
    .page-content-wrapper h4 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 2rem;
    }

    .react-button .text-primary {
        color: #ac0027 !important;
    }

    .post-box .post-count-details {
        font-size: 12px;
    }

    .mt-1.pt-3.text-center.widgets-footer a {
        font-size: 12px !important;
        text-align: left !important;
    }

    .side-menu.px-1.px-md-2.px-lg-3 a.btn.btn-round.btn-primary.btn-block {
        display: inline-block;
        width: auto;
        margin-top: 2rem;
    }

    div#loader_js {
        background: #e190e1;
        position: fixed;
        height: 100vh;
        width: 100%;
        z-index: 2000;
        align-items: center;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .loaded div#loader_js {
        display: none !important;
    }

    div#loader_js svg {
        height: 40px;
    }

    .form-control:focus {
        color: #ffffff;
    }

    h5.card-title.pl-2.mb-0 {
        font-size: 1rem;
        font-weight: bold;
        position: relative;
        top: .5rem;
    }

    .m-0.message-bubble.text-break.alert.alert-default {
        background: #10141f !important;
    }

    .cc-floating.cc-theme-classic {
        padding: 2rem;
        border-radius: 5px;
        font-size: 10px;
        background: #0d1018 !important;
        color: #fff !important;
        right: auto !important;
        left: 2rem;
        bottom: 2rem;
        max-width: 300px;
    }

    .cc-floating.cc-theme-classic a.cc-link {
        color: rgb(0, 123, 255);
    }

    .navbar-dark .navbar-nav .nav-link {
        color: hsl(0deg 0% 100%);
        font-weight: 600;
    }

    body {
        max-width: 100%;
        width: 100%;
        overflow-x: hidden;
    }

    span#amount-label,
    input#deposit-amount,
    input#withdrawal-amount,
    input#checkout-amount {
        height: 40px;
    }

    .radio.selected {
        box-shadow: 0px 0px 0px 1px #e190e1;
        border: 2px solid #e190e1;
    }

    .suggestion-box .suggestion-box .m-0.text-truncate.h6 {
        font-weight: 600;
    }


    .pointer-cursor-hidden {
       text-align:center;
        overflow: hidden;
    }

    .contenu_payant a,
    .contenu_payant a *,
    .contenu_payant * {
        pointer-events: none !important;
        filter: blur(40px);
    }

    .post-content {
        position: relative;
    }

    .visit_middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    a.text-white.middl_avatar {
        display: block;
        text-align: center;
        margin-bottom: 2vw;
    }


    body {
        background-color: #000;
        color: #fff;
    }


    footer,
    .sidebar {
        background-color: #000000;
    }

    .user-side-menu .nav-item .side-menu-label {
        font-size: 14px;
    }

    .bg-dark,
    .home-bg-section {
        background-color: #000000 !important;
    }

   @media screen and (max-width:992px){
        .home_is_mobile_js {
            padding-top: 18rem !important;
        }
   }
</style>


<style>

video.video-preview.w-100,
img.img-fluid.blur.img-fluid.rounded-0.w-100 {
    max-height: 600px;
}

img.img-fluid.blur.img-fluid.rounded-0.w-100 {
   width: auto!important;
}


    .slugmenu_rates,
    .slugmenu_privacy,
    .slugmenu_verify,
    .nav_mobile_privacy , 
    .nav_mobile_rates, 
    .nav_mobile_verify {
        display: none!important;
    }

    .nav_is_mobile_hack .mCustomScrollBox {
        width: 100%;
        padding-right: 1rem;
    }


    .mes_gains {
    padding: 1.5rem;
    background: #090609;
    margin: 1rem;
    border-radius: 10px;
    display: flex;
    align-items: center;
}
.mes_gains  svg{
    height: 1.5rem;
    width: auto;
}

.mes_gains_texte {
    font-size: 12px;
    font-weight: 600;
    padding-top: 8px;
}

.mes_gains_chiffres {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 0;
    line-height: 1.5;
}

.gains_si_mobile{
    display: none;
}

@media screen and (max-width: 600px){
    .gains_si_mobile{
        display: block;
    }

    .mes_gains {
        display: flex;
        background: transparent;
        padding: 0 0 0 1rem;
        margin: 0;
        align-items: center;
    }

    .mes_gains svg{
        margin-right: .5rem;
    }

    .mes_gains_chiffres {
        margin-bottom: 0;
        line-height: 1.5;
        padding-top: 0;
    }

    .feed-mobile-search{
        align-items: center;
    }
}

.post-media {
        position: relative;
    }

    img.filigrane {
    height: 100px;
    margin-bottom: .5rem;
    margin-left: auto;
    margin-right: auto;
    width: auto;
}


.visit_middle {
    justify-content: center;
    display: flex;
    flex-wrap: wrap;
}

.contenu_payant img {
    height: 600px;
    object-fit: cover;
    object-position: center;
}

</style>

@if(Auth::check())
@if(Auth::user()->email_verified_at && Auth::user()->birthdate && (Auth::user()->verification &&
Auth::user()->verification->status == 'verified'))
@if(Auth::user()->verification->compte_createur == 'oui')

<style>
    .slugmenu_rates,
    .slugmenu_privacy,
    .slugmenu_verify ,
    .nav_mobile_privacy , 
    .nav_mobile_rates, 
    .nav_mobile_verify{
        display: flex!important;
    }

    .menu_devenir_createur{
        display: none!important;
    }
</style>
@endif
@endif
@endif