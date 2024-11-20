@extends('layouts.user-no-nav')
@section('page_title', __('Your feed'))

{{-- Page specific CSS --}}
@section('styles')
{!!
Minify::stylesheet([
'/libs/swiper/swiper-bundle.min.css',
'/libs/photoswipe/dist/photoswipe.css',
'/css/pages/checkout.css',
'/libs/photoswipe/dist/default-skin/default-skin.css',
'/css/pages/feed.css',
'/css/posts/post.css',
'/css/pages/search.css',
])->withFullUrl()
!!}
@if(getSetting('feed.post_box_max_height'))
@include('elements.feed.fixed-height-feed-posts', ['height' => getSetting('feed.post_box_max_height')])
@endif
@stop

{{-- Page specific JS --}}
@section('scripts')
{!!
Minify::javascript([
'/js/PostsPaginator.js',
'/js/CommentsPaginator.js',
'/js/Post.js',
'/js/SuggestionsSlider.js',
'/js/pages/lists.js',
'/js/pages/feed.js',
'/js/pages/checkout.js',
'/libs/swiper/swiper-bundle.min.js',
'/js/plugins/media/photoswipe.js',
'/libs/photoswipe/dist/photoswipe-ui-default.min.js',
'/libs/@joeattardi/emoji-button/dist/index.js',
'/js/plugins/media/mediaswipe.js',
'/js/plugins/media/mediaswipe-loader.js',
])->withFullUrl()
!!}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-8 col-md-7 second p-0 ">
            <div class="d-flex d-md-none px-3 py-3 feed-mobile-search neutral-bg fixed-top-m">
                @include('elements.search-box')

                <div class="gains_si_mobile">
                    @auth
                    <div class="mes_gains">
                        <svg width="750px" height="600px" viewBox="0 0 750 600" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                <g id="cash-outline-svgrepo-com" transform="translate(25.000000, 25.000000)" stroke="#FFFFFF" stroke-width="50">
                                    <rect id="Rectangle" transform="translate(350.000000, 200.000000) rotate(180.000000) translate(-350.000000, -200.000000) " x="0" y="5.68434189e-14" width="700" height="400" rx="25"></rect>
                                    <line x1="50" y1="475" x2="650" y2="475" id="Path" stroke-linecap="round"></line>
                                    <line x1="100" y1="550" x2="600" y2="550" id="Path" stroke-linecap="round"></line>
                                    <circle id="Oval" stroke-linecap="round" cx="350" cy="200" r="125"></circle>
                                    <path d="M700,125 C630.964406,125 575,69.0355937 575,2.84217094e-14" id="Path" stroke-linecap="round"></path>
                                    <path d="M-2.84217094e-14,125 C33.1520612,125 64.9463003,111.830395 88.3883476,88.3883476 C111.830395,64.9463003 125,33.1520612 125,0" id="Path" stroke-linecap="round"></path>
                                    <path d="M700,275 C630.964406,275 575,330.964406 575,400" id="Path" stroke-linecap="round"></path>
                                    <path d="M-2.84217094e-14,275 C33.1520612,275 64.9463003,288.169605 88.3883476,311.611652 C111.830395,335.0537 125,366.847939 125,400" id="Path" stroke-linecap="round"></path>
                                </g>
                            </g>
                        </svg>

                        <div class="fond_media">
                            <div class="mes_gains_chiffres">
                                {{\App\Providers\SettingsServiceProvider::getWebsiteFormattedAmount(number_format(Auth::user()->wallet->total, 2, '.', ''))}}
                            </div>
                        </div>
                    </div>

                    @endauth
                </div>
            </div>

            @if(!getSetting('feed.hide_suggestions_slider'))
            <div class="d-block d-md-none d-lg-none m-pt-70 feed-suggestions-wrapper">
                @include('elements.feed.suggestions-box',['profiles'=>$suggestions, 'isMobile'=> true])
            </div>
            @endif

            {{-- @include('elements.user-stories-box')--}}

            <div class="">
                @include('elements.message-alert',['classes'=>'pt-4 pb-4 px-2'])
                @include('elements.feed.posts-load-more')
                <div class="feed-box mt-0 pt-4 posts-wrapper">
                   
                    @if(count($posts))
                        @foreach($posts as $post)
                            @include('elements.feed.post-box')
                            <hr>
                        @endforeach
                        @include('elements.report-user-or-post',['reportStatuses' => ListsHelper::getReportTypes()])
                        @include('elements.feed.post-delete-dialog')
                        @include('elements.feed.post-list-management')
                        @include('elements.photoswipe-container')
                    @else
                            @foreach($allPosts as $post)
                            @include('elements.feed.post-suggestion')
                            @endforeach

                            <div class="pagination d-flex justify-content-center mt-3">
                              @if ($allPosts->hasMorePages())
                                    <a href="{{ $allPosts->nextPageUrl() }}" class="btn btn-primary" id="load-more">Suivant</a>
                                @endif
                            </div>

                           

                    @endif



                </div>
                @include('elements.feed.posts-loading-spinner')
            </div>
        </div>
        <div
            class="col-12 col-sm-12 col-md-5 col-lg-4 first border-left pt-4 pb-5 min-vh-100 suggestions-wrapper ">

            <div class="feed-widgets">
                <div class="mb-3 d-none d-md-block">
                    @include('elements.search-box')
                </div>

                <div class="suggestions-content">
                    @foreach ($userVerifieds as $userVerified)
                    @if ($userVerified->status === 'verified' && $userVerified->compte_createur === 'oui')

                    <div class="suggestion-box card text-white mb-2 border-0 rounded">
                        <div style="background: url({{ $userVerified->user->cover ?? 'N/A' }});"
                            class="card-img suggestion-header-bg"></div>
                        <div class="card-img-overlay p-0">
                            <div class="h-100 w-100 p-0 m-0 position-absolute z-index-0">
                                <div class="h-50">
                                </div>
                                <div class="h-50 w-100 half-bg d-flex"></div>
                            </div>
                            <div class="card-text w-100 h-100 d-flex">

                                <div class="d-flex align-items-center justify-content-center px-3 z-index-3">
                                    <img src="{{ $userVerified->user->avatar ?? 'N/A' }}"
                                        class="avatar rounded-circle" /> 
                                </div>

                                <div class="w-100 z-index-3 text-truncate">
                                    <div class="h-50 d-flex flex-row-reverse pr-1">

                                    </div>
                                    <div
                                        class="h-50 w-100 z-index-3 d-flex flex-column justify-content-center text-truncate pr-2">
                                        <div class="m-0 h6 text-truncate"><a
                                                href="{{ route('profile', ['username' => $userVerified->user->username ?? 'N/A']) }}"
                                                class="text-white d-flex align-items-center font-weight-bold">
                                                {{ $userVerified->user->name ?? 'N/A' }}

                                                <span data-toggle="tooltip" data-placement="top"
                                                    title="{{__('Verified user')}}">

                                                    <svg width="19px" height="19px" viewBox="0 0 19 19" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        style="width: auto; margin-left: 0.2rem; height: 14px;">
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <g id="x" transform="translate(-0.000000, 0.000000)"
                                                                fill-rule="nonzero">
                                                                <path
                                                                    d="M18.792,9.396 C18.774,8.75 18.577,8.121 18.222,7.58 C17.868,7.04 17.37,6.608 16.784,6.334 C17.007,5.727 17.054,5.07 16.924,4.437 C16.793,3.803 16.487,3.219 16.042,2.75 C15.572,2.305 14.989,2 14.355,1.868 C13.722,1.738 13.065,1.785 12.458,2.008 C12.185,1.421 11.754,0.922 11.213,0.568 C10.672,0.214 10.043,0.016 9.396,8.8817842e-16 C8.75,0.017 8.123,0.213 7.583,0.568 C7.043,0.923 6.614,1.422 6.343,2.008 C5.735,1.785 5.076,1.736 4.441,1.868 C3.806,1.998 3.221,2.304 2.751,2.75 C2.306,3.22 2.002,3.805 1.873,4.438 C1.743,5.071 1.793,5.728 2.017,6.334 C1.43,6.608 0.93,7.039 0.574,7.579 C0.218,8.119 0.019,8.749 -4.4408921e-16,9.396 C0.02,10.043 0.218,10.672 0.574,11.213 C0.93,11.753 1.43,12.185 2.017,12.458 C1.793,13.064 1.743,13.721 1.873,14.354 C2.003,14.988 2.306,15.572 2.75,16.042 C3.22,16.485 3.804,16.789 4.437,16.92 C5.07,17.052 5.727,17.004 6.334,16.784 C6.608,17.37 7.039,17.868 7.58,18.223 C8.12,18.577 8.75,18.774 9.396,18.792 C10.043,18.776 10.672,18.579 11.213,18.225 C11.754,17.871 12.185,17.371 12.458,16.785 C13.062,17.024 13.724,17.081 14.361,16.949 C14.997,16.817 15.581,16.502 16.041,16.042 C16.501,15.582 16.817,14.998 16.949,14.361 C17.081,13.724 17.024,13.062 16.784,12.458 C17.37,12.184 17.868,11.753 18.223,11.212 C18.577,10.672 18.774,10.042 18.792,9.396 L18.792,9.396 Z"
                                                                    id="Shape" fill="#1D9BF0"></path>
                                                                <polygon id="Path" fill="#FFFFFF"
                                                                    points="8.058 13.246 4.629 9.818 5.922 8.516 7.994 10.588 12.394 5.794 13.741 7.04">
                                                                </polygon>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </span>

                                            </a></div>
                                        <div class="m-0 text-truncate">

                                            <span>@</span><a
                                                href="{{ route('profile', ['username' => $userVerified->user->username ?? 'N/A']) }}"
                                                class="text-white">


                                                {{ $userVerified->user->username ?? 'N/A' }}
                                            </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endif
                    @endforeach
                </div>


                @if(!getSetting('feed.hide_suggestions_slider'))
                @include('elements.feed.suggestions-box',['profiles'=>$suggestions, 'isMobile'=> false])
                @endif
                @if(getSetting('custom-code-ads.sidebar_ad_spot'))
                <div class="mt-3">
                    {!! getSetting('custom-code-ads.sidebar_ad_spot') !!}
                </div>
                @endif

                @include('template.footer-feed')

            </div>

        </div>
    </div>
    @include('elements.checkout.checkout-box')
</div>

<div class="d-none">
    <ion-icon name="heart"></ion-icon>
    <ion-icon name="heart-outline"></ion-icon>
</div>

@include('elements.standard-dialog',[
'dialogName' => 'comment-delete-dialog',
'title' => __('Delete comment'),
'content' => __('Are you sure you want to delete this comment?'),
'actionLabel' => __('Delete'),
'actionFunction' => 'Post.deleteComment();',
])

@stop