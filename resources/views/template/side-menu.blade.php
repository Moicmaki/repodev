<div class="side-menu px-1 px-md-2 px-lg-3">
    <div class="user-details mb-4 d-flex open-menu pointer-cursor flex-row-no-rtl">
        <div class="ml-0 ml-md-2">
            @if(Auth::check())
                <img src="{{Auth::user()->avatar}}" class="rounded-circle user-avatar">
            @else
                <div class="avatar-placeholder">
                    @include('elements.icon',['icon'=>'person-circle','variant'=>'xlarge text-muted'])
                </div>
            @endif
        </div>
        @if(Auth::check())
           
        @endif
    </div>
    <ul class="nav flex-column user-side-menu">
        <li class="nav-item ">
            <a href="{{Auth::check() ? route('feed') : route('home')}}" class="h-pill h-pill-primary nav-link {{Route::currentRouteName() == 'feed' ? 'active' : ''}} d-flex justify-content-between">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        @include('elements.icon',['icon'=>'home-outline','variant'=>'large'])
                    </div>
                    <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Home')}}</span>
                </div>
            </a>
        </li>

        @if(Auth::check())
            <li class="nav-item">
                <a href="/search?query=&filter=people" class="nav-link h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'compass-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Explore')}}</span>
                    </div>
                </a>
            </li>
          @endif


        @if(GenericHelper::isEmailEnforcedAndValidated())
            <li class="nav-item">
                <a href="{{route('my.notifications')}}" class="nav-link h-pill h-pill-primary {{Route::currentRouteName() == 'my.notifications' ? 'active' : ''}} d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center position-relative">
                            @include('elements.icon',['icon'=>'notifications-outline','variant'=>'large'])
                            <div class="menu-notification-badge notifications-menu-count {{(isset($notificationsCountOverride) && $notificationsCountOverride->total > 0 ) || (NotificationsHelper::getUnreadNotifications()->total > 0) ? '' : 'd-none'}}">
                                {{!isset($notificationsCountOverride) ? NotificationsHelper::getUnreadNotifications()->total : $notificationsCountOverride->total}}
                            </div>
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Notifications')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('my.messenger.get') }}" class="nav-link {{ Route::currentRouteName() == 'my.messenger.get' ? 'active' : '' }} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center position-relative">
                            @include('elements.icon', ['icon' => 'chatbubble-outline', 'variant' => 'large'])
                            <div id="notification-badge-container" class="menu-notification-badge chat-menu-count {{ (NotificationsHelper::getUnreadMessages() > 0) ? '' : 'd-none' }}">
                                {{ NotificationsHelper::getUnreadMessages() }}
                            </div>
                            <!-- @if($unreadMessageCount >= 1)
                                <div class="menu-notification-badge chat-menu-count">
                                    {{ __(':count', ['count' => $unreadMessageCount]) }}
                                </div>
                            @endif -->

                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{ __('Messages') }}</span>
                    </div>
                </a>
            </li>

           
            @if(getSetting('streams.allow_streams'))
                <li class="nav-item">
                    <a href="{{route('search.get')}}?filter=live" class="nav-link {{Route::currentRouteName() == 'search.get' && request()->get('filter') == 'live' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="icon-wrapper d-flex justify-content-center align-items-center position-relative">
                                @include('elements.icon',['icon'=>'play-circle-outline','variant'=>'large'])
                                <div class="menu-notification-badge streams-menu-count {{(StreamsHelper::getPublicLiveStreamsCount() > 0) ? '' : 'd-none'}}">
                                    {{StreamsHelper::getPublicLiveStreamsCount()}}
                                </div>
                            </div>
                            <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Streams')}}</span>
                        </div>

                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{route('my.bookmarks')}}" class="nav-link {{Route::currentRouteName() == 'my.bookmarks' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'bookmark-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Bookmarks')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('my.lists.all')}}" class="nav-link {{Route::currentRouteName() == 'my.lists.all' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'list-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Lists')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('my.settings',['type'=>'subscriptions'])}}" class="nav-link {{Route::currentRouteName() == 'my.settings' &&  is_int(strpos(Request::path(),'subscriptions')) ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'people-circle-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Subscriptions')}}</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('profile',['username'=>Auth::user()->username])}}" class="nav-link {{Route::currentRouteName() == 'profile' && (request()->route("username") == Auth::user()->username) ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'person-circle-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('My profile')}}</span>
                    </div>
                </a>
            </li>
        @endif



        @if(Auth::check())
            <li class="nav-item menu_devenir_createur">
                <a href="/my/settings/verify" class="nav-link {{Route::currentRouteName() == 'search.get' ? 'active' : ''}} h-pill h-pill-primary d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                            @include('elements.icon',['icon'=>'star-outline','variant'=>'large'])
                        </div>
                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('Devenir createur')}}</span>
                    </div>
                </a>
            </li>
          @endif

          @if(Auth::check())
                    @if(Auth::user()->email_verified_at && Auth::user()->birthdate && (Auth::user()->verification && Auth::user()->verification->status == 'verified'))
                        @if(Auth::user()->verification->compte_createur == 'oui')
                        <li class="nav-item">
                                <a href="/my/settings/wallet" class="nav-link  h-pill h-pill-primary d-flex justify-content-between">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="icon-wrapper d-flex justify-content-center align-items-center">
                                        @include('elements.icon',['icon'=>'cash-outline','variant'=>'large'])
                                        </div>
                                        <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">Revenu</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endif
            @endif
      
            
     
        <li class="nav-item">
            <a href="#" role="button" class="open-menu nav-link h-pill h-pill-primary text-muted d-flex justify-content-between">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icon-wrapper d-flex justify-content-center align-items-center">
                        @include('elements.icon',['icon'=>'ellipsis-horizontal-circle-outline','variant'=>'large'])
                    </div>
                    <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate side-menu-label">{{__('More')}}</span>
                </div>
            </a>
        </li>

 


        @if(GenericHelper::isEmailEnforcedAndValidated())
            @if(getSetting('streams.allow_streams'))
                <li class="nav-item-live mt-2 mb-0">
                    <a role="button" class="btn btn-round btn-outline-danger btn-block px-3" href="{{route('my.streams.get')}}{{StreamsHelper::getUserInProgressStream() ? '' : ( !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? '' : '?action=create')}}">
                        <div class="d-none d-md-flex d-xl-flex d-lg-flex justify-content-center align-items-center ml-1 text-truncate new-post-label">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="stream-on-label w-100 {{StreamsHelper::getUserInProgressStream() ? '' : 'd-none'}}">
                                    <div class="d-flex align-items-center w-100">
                                        <div class="mr-4"><div class="blob red"></div></div>
                                        <div class="ml-1">{{__('On air')}} </div>
                                    </div>
                                </div>
                                <div class="stream-off-label w-100 {{StreamsHelper::getUserInProgressStream() ? 'd-none' : ''}}">
                                    <div class="d-flex  align-items-center w-100">
                                        <div class="mr-3"> @include('elements.icon',['icon'=>'ellipse','variant'=>'','classes'=>'flex-shrink-0 text-danger'])</div>
                                        <div class="ml-1">{{__('Go live')}} </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-block d-md-none d-flex align-items-center justify-content-center">@include('elements.icon',['icon'=>'add-circle-outline','variant'=>'medium','classes'=>'flex-shrink-0'])</div>
                    </a>
                </li>
            @endif
        @endif

     
            @if(Auth::check())
                    @if(Auth::user()->email_verified_at && Auth::user()->birthdate && (Auth::user()->verification && Auth::user()->verification->status == 'verified'))
                        @if(Auth::user()->verification->compte_createur == 'oui')
                        
            
                        <li class="nav-item">
                            <a role="button" class="btn btn-round btn-primary btn-block " href="{{route('posts.create')}}">
                                <span class="d-none d-md-block d-xl-block d-lg-block ml-2 text-truncate new-post-label">{{__('New post')}}</span>
                                <span class="d-block d-md-none d-flex align-items-center justify-content-center">@include('elements.icon',['icon'=>'add-circle-outline','variant'=>'medium','classes'=>'flex-shrink-0'])</span>
                            </a>
                        </li>

                        @endif
                    @endif
            @endif
      

        

    </ul>


    @auth
    <div class="mes_gains">
        <svg width="750px" height="600px" viewBox="0 0 750 600" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mr-2">
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
        <div class="mes_gains_chiffres">
            {{\App\Providers\SettingsServiceProvider::getWebsiteFormattedAmount(number_format(Auth::user()->wallet->total, 2, '.', ''))}}
        </div>
    </div>

    @endauth


</div>
