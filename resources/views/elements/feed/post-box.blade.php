<div class="post-box" data-postID="{{$post->id}}">
    <div class="post-header pl-3 pr-3 ">
        <div class="d-flex">
            <div class="avatar-wrapper">
                <img class="avatar rounded-circle" src="{{$post->user->avatar}}">
            </div>
            <div class="post-details pl-2 w-100{{$post->is_pinned ? '' : '' }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-bold"><a href="{{route('profile',['username'=>$post->user->username])}}" class="text-dark-r">{{$post->user->name}}</a></div>
                        <div><a href="{{route('profile',['username'=>$post->user->username])}}" class="text-dark-r text-hover"><span>@</span>{{$post->user->username}}</a></div>
                    </div>

                    <div class="d-flex">

                        @if(Auth::check() && (($post->user_id === Auth::user()->id && $post->status == 0) || (Auth::user()->role_id === 1) && $post->status == 0) )
                            <div class="pr-3 pr-md-3"><span class="badge badge-pill bg-gradient-faded-secondary">{{ucfirst(__("pending"))}}</span></div>
                        @endif

                        @if($post->expire_date)
                            <div class="pr-3 pr-md-3">
                                    <span class="badge badge-pill bg-gradient-faded-primary"  data-toggle="{{!$post->is_expired ? 'tooltip' : ''}}" data-placement="bottom" title="{{!$post->is_expired ? __('Expiring in') .''. \Carbon\Carbon::parse($post->expire_date)->diffForHumans(null,false,true) : ''}}">
                                        {{!$post->is_expired ? ucfirst(__("Expiring")) : ucfirst(__("Expired"))}}
                                    </span>
                            </div>
                        @endif
                        @if(Auth::check() && $post->release_date && Auth::user()->id === $post->user_id && $post->is_scheduled)
                            @if($post->release_date > \Carbon\Carbon::now())
                                <div class="pr-3 pr-md-3">
                                        <span class="badge badge-pill bg-gradient-faded-primary" data-toggle="{{$post->is_scheduled ? 'tooltip' : ''}}" data-placement="bottom" title="{{$post->is_scheduled ? __('Posting in') .''. \Carbon\Carbon::parse($post->release_date)->diffForHumans(null,false,true) : ''}}">
                                            {{ucfirst(__("Scheduled"))}}
                                        </span>
                                </div>
                            @endif
                        @endif
                        @if(Auth::check() && $post->user_id === Auth::user()->id && $post->price > 0)
                            <div class="pr-3 pr-md-3"><span class="badge badge-pill bg-gradient-faded-primary">{{ucfirst(__("PPV"))}}</span></div>
                        @endif

                        @if(Auth::check() && $post->user_id === Auth::user()->id)
                            <div class="pr-3 pr-md-3 pt-1 {{$post->is_pinned ? '' : 'd-none'}} pinned-post-label">
                            <span data-toggle="tooltip" data-placement="bottom" title="{{__("Pinned post")}}">
                                @include('elements.icon',['icon'=>'pricetag-outline', 'classes' => 'text-primary'])
                            </span>
                            </div>
                        @endif

                        <div class="pr-3 pr-md-3">
                            <a class="text-dark-r text-hover d-flex" onclick="PostsPaginator.goToPostPageKeepingNav({{$post->id}},{{$post->postPage}},'{{route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username])}}')" href="javascript:void(0)">
                                {{$post->created_at->diffForHumans(null,false,true)}}
                            </a>
                        </div>
                        <div class="dropdown {{GenericHelper::getSiteDirection() == 'rtl' ? 'dropright' : 'dropleft'}}">
                            <a class="btn btn-sm text-dark-r text-hover btn-outline-{{(Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? 'dark' : 'light') : (Cookie::get('app_theme') == 'dark' ? 'dark' : 'light'))}} dropdown-toggle px-2 py-1 m-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                @include('elements.icon',['icon'=>'ellipsis-horizontal-outline'])
                            </a>
                            <div class="dropdown-menu">
                                <!-- Dropdown menu links -->
                                <a class="dropdown-item" href="javascript:void(0)" onclick="shareOrCopyLink('{{route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username])}}')">{{__('Copy post link')}}</a>
                                @if(Auth::check())
                                    <a class="dropdown-item bookmark-button {{PostsHelper::isPostBookmarked($post->bookmarks) ? 'is-active' : ''}}" href="javascript:void(0);" onclick="Post.togglePostBookmark({{$post->id}});">{{PostsHelper::isPostBookmarked($post->bookmarks) ? __('Remove the bookmark') : __('Bookmark this post') }} </a>
                                    @if(Auth::user()->id === $post->user_id)
                                        <a class="dropdown-item pin-button {{$post->is_pinned ? 'is-active' : ''}}" href="javascript:void(0);" onclick="Post.togglePostPin({{$post->id}});">{{$post->is_pinned ? __('Un-pin post') : __('Pin this post') }} </a>
                                    @endif
                                        @if(Auth::check() && Auth::user()->id != $post->user->id)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="Lists.showListManagementConfirmation('{{'unfollow'}}', {{$post->user->id}});">{{__('Unfollow')}}</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="Lists.showListManagementConfirmation('{{'block'}}', {{$post->user->id}});">{{__('Block')}}</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="Lists.showReportBox({{$post->user->id}},{{$post->id}});">{{__('Report')}}</a>
                                    @endif
                                    @if(Auth::check() && Auth::user()->id == $post->user->id)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('posts.edit',['post_id'=>$post->id])}}">{{__('Edit post')}}</a>
                                        @if(!getSetting('compliance.minimum_posts_deletion_limit') || (getSetting('compliance.minimum_posts_deletion_limit') > 0 && count($post->user->posts) > getSetting('compliance.minimum_posts_deletion_limit')))
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="Post.confirmPostRemoval({{$post->id}});">{{__('Delete post')}}</a>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="post-content mt-3 {{count($post->attachments) ? "mb-3" : ""}} pl-3 pr-3">
        <div class="text-break post-content-data {{getSetting('feed.enable_post_description_excerpts') && (strlen($post->text) >= 85 || substr_count($post->text,"\r\n") > 1) ? 'line-clamp-3 /*pb-0 mb-0*/' : ''}}">
            {!!   GenericHelper::parseSafeHTML($post->text) !!}
        </div>
        @if(getSetting('feed.enable_post_description_excerpts') && (strlen($post->text) >= 85 || substr_count($post->text,"\r\n") > 1))
            <div class="text-primary pointer-cursor {{count($post->attachments) ? "mb-3" : ""}}" onclick="Post.toggleFullDescription({{$post->id}})">
                <span class="label-more">{{__('Show more')}}</span>
                <span class="label-less d-none">{{__('Show less')}}</span>
            </div>
        @endif
    </div>

    @if(count($post->attachments))
        <div class="post-media">
        @if($post->isSubbed || (getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
            @if((Auth::check() && Auth::user()->id !== $post->user_id && $post->price > 0 && !PostsHelper::hasUserUnlockedPost($post->postPurchases)) 
                || (!Auth::check() && $post->price > 0))
              
              <div class="pointer-cursor-hidden llna">
                @php
                    // Récupérer les pièces jointes avec le même post_id
                    $attachments = DB::table('attachments')->where('post_id', $post->id)->get();
                @endphp

                @if($attachments->isNotEmpty())
                    <!-- Afficher uniquement la première pièce jointe -->
                    <img src="{{ Storage::url($attachments->first()->filename) }}" alt="Attachment" class="img-fluid" style="  filter: blur(40px)!important;">
                @else
                    <!-- Vous pouvez ajouter un message ici si nécessaire -->
                @endif
            </div>
            
                @include('elements.feed.post-locked', ['type' => 'post', 'post' => $post])
            @else
                @if(count($post->attachments) > 1)
                    <div class="swiper-container mySwiper pointer-cursor izyveito">
                        <div class="swiper-wrapper">
                            @foreach($post->attachments as $attachment)
                                <div class="swiper-slide">
                                    @include('elements.feed.post-box-media-wrapper', [
                                        'attachment' => $attachment,
                                        'isGallery' => true,
                                    ])
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button swiper-button-next p-pill-white">
                            @include('elements.icon', ['icon' => 'chevron-forward-outline'])
                        </div>
                        <div class="swiper-button swiper-button-prev p-pill-white">
                            @include('elements.icon', ['icon' => 'chevron-back-outline'])
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    @include('elements.feed.post-box-media-wrapper', [
                        'attachment' => $post->attachments[0],
                        'isGallery' => false,
                    ])
                @endif
            @endif
        @else
        <div class="pointer-cursor-hidden llna">
            @php
                // Récupérer les pièces jointes avec le même post_id
                $attachments = DB::table('attachments')->where('post_id', $post->id)->get();
            @endphp

            @if($post->publication_gratuite == 1)


            @if($attachments->isNotEmpty())
                @php
                    $filename = $attachments->first()->filename;
                @endphp
                
                @if(Str::endsWith($filename, ['.jpg', '.jpeg', '.png', '.gif']))
                    <img src="{{ Storage::url($filename) }}" alt="Image Attachment" class="img-fluid">
                @elseif(Str::endsWith($filename, ['.mp4', '.mov', '.avi']))
                    <video class="video-preview w-100" controls>
                        <source src="{{ Storage::url($filename) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @endif

            @else

                <!-- Payant ici  -->

                @if($attachments->isNotEmpty())
                    @php
                        $filename = $attachments->first()->filename;
                    @endphp
                    
                    @if(Str::endsWith($filename, ['.jpg', '.jpeg', '.png', '.gif']))
                        <img src="{{ Storage::url($filename) }}" alt="Image Attachment" class="img-fluid" style="filter: blur(40px) !important;">
                    @elseif(Str::endsWith($filename, ['.mp4', '.mov', '.avi']))
                        <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                            <a href="#">
                                <video style="filter: blur(40px) !important;" class="video-preview w-100" src="{{ Storage::url($filename) }}"></video>
                            </a>
                        </div>
                    @endif
                @endif

                <!-- Block lock -->

                <div class="visit_middle">
                
                       <a href="#">
                       <img src="{{asset('/img/filigrane.png')}}" alt="filigrane" class="filigrane">
                       </a>


                            @if($post->price > 0)
                                <a href="#" class="btn btn-primary">
                                    Déverrouiller le post pour {{ $post->price }}€
                                </a>
                            @endif
                        
                      


                    </div>
                    

                <!-- Fin payant ici  -->

            @endif


        </div>
            @include('elements.feed.post-locked', ['type' => 'subscription'])
        @endif

        </div>
    @endif
    <div class="post-footer mt-3 pl-3 pr-3">
        <div class="footer-actions d-flex justify-content-between">
            <div class="d-flex">
                {{-- Likes --}}
                @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
                    <div class="h-pill h-pill-primary mr-1 rounded react-button {{PostsHelper::didUserReact($post->reactions) ? 'active' : ''}}" data-toggle="tooltip" data-placement="top" title="{{__('Like')}}" onclick="Post.reactTo('post',{{$post->id}})">
                        @if(PostsHelper::didUserReact($post->reactions))
                            @include('elements.icon',['icon'=>'heart', 'variant' => 'medium', 'classes' =>"text-primary"])
                        @else
                            @include('elements.icon',['icon'=>'heart-outline', 'variant' => 'medium'])
                        @endif
                    </div>
                @else
                    <div class="h-pill h-pill-primary mr-1 rounded react-button disabled">
                        @include('elements.icon',['icon'=>'heart-outline', 'variant' => 'medium'])
                    </div>
                @endif
                {{-- Comments --}}
                @if(Route::currentRouteName() != 'posts.get')
                    @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
                        <div class="h-pill h-pill-primary mr-1 rounded" data-toggle="tooltip" data-placement="top" title="{{__('Show comments')}}" onClick="Post.showPostComments({{$post->id}},6)">
                            @include('elements.icon',['icon'=>'chatbubble-outline', 'variant' => 'medium'])
                        </div>
                    @else
                        <div class="h-pill h-pill-primary mr-1 disabled rounded">
                            @include('elements.icon',['icon'=>'chatbubble-outline', 'variant' => 'medium'])
                        </div>
                    @endif
                @endif
                {{-- Tips --}}
                @if(Auth::check() && $post->user->id != Auth::user()->id)
                    @if($post->isSubbed || (getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
                        <div class="h-pill h-pill-primary send-a-tip to-tooltip poi {{(!GenericHelper::creatorCanEarnMoney($post->user)) ? 'disabled' : ''}}"
                             @if(!GenericHelper::creatorCanEarnMoney($post->user))
                             data-placement="top"
                             title="{{__('This creator cannot earn money yet')}}">
                            @else
                                data-toggle="modal"
                                data-target="#checkout-center"
                                data-post-id="{{$post->id}}"
                                data-type="tip"
                                data-first-name="{{Auth::user()->first_name}}"
                                data-last-name="{{Auth::user()->last_name}}"
                                data-billing-address="{{Auth::user()->billing_address}}"
                                data-country="{{Auth::user()->country}}"
                                data-city="{{Auth::user()->city}}"
                                data-state="{{Auth::user()->state}}"
                                data-postcode="{{Auth::user()->postcode}}"
                                data-available-credit="{{Auth::user()->wallet->total}}"
                                data-username="{{$post->user->username}}"
                                data-name="{{$post->user->name}}"
                                data-avatar="{{$post->user->avatar}}"
                                data-recipient-id="{{$post->user_id}}">
                            @endif
                            <div class=" d-flex align-items-center">
                                @include('elements.icon',['icon'=>'gift-outline', 'variant' => 'medium'])
                                <div class="ml-1 d-none d-lg-block"> {{__('Send a tip')}} </div>
                            </div>
                        </div>
                    @else
                        <div class="h-pill h-pill-primary send-a-tip disabled">
                            <div class=" d-flex align-items-center">
                                @include('elements.icon',['icon'=>'gift-outline', 'variant' => 'medium'])
                                <div class="ml-1 d-none d-md-block"> {{__('Send a tip')}} </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="mt-0 d-flex align-items-center justify-content-center post-count-details">
                <span class="ml-2-h">
                    <strong class="text-bold post-reactions-label-count">{{count($post->reactions)}}</strong>
                    <span class="post-reactions-label">{{trans_choice('likes', count($post->reactions))}}</span>
                </span>
                @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
                    <span class="ml-2-h d-none d-lg-block">
                    <a href="{{Route::currentRouteName() != 'posts.get' ? route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username]) : '#comments'}}" class="text-dark-r text-hover">
                        <strong class="post-comments-label-count">{{count($post->comments)}}</strong>
                       <span class="post-comments-label">
                        {{trans_choice('comments',  count($post->comments))}}
                       </span>
                    </a>
                </span>
                @else
                    <span class="ml-2-h d-none d-lg-block">
                        <strong class="post-comments-label-count">{{count($post->comments)}}</strong>
                       <span class="post-comments-label">
                        {{trans_choice('comments',  count($post->comments))}}
                       </span>
                </span>
                @endif
                <span class="ml-2-h d-none d-lg-block">
                    <strong class="post-tips-label-count">{{$post->tips_count}}</strong>
                    <span class="post-tips-label">{{trans_choice('tips',$post->tips_count)}}</span>
                </span>
            </div>
        </div>
    </div>

    @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
        <div class="post-comments d-none" {{Route::currentRouteName() == 'posts.get' ? 'id="comments"' : ''}}>
            <hr>

            <div class="px-3 post-comments-wrapper">
                <div class="comments-loading-box">
                    @include('elements.preloading.messenger-contact-box',['limit'=>1])
                </div>
            </div>
            <div class="show-all-comments-label pl-3 d-none">
                @if(Route::currentRouteName() != 'posts.get')
                    <a href="javascript:void(0)" onclick="PostsPaginator.goToPostPageKeepingNav({{$post->id}},{{$post->postPage}},'{{route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username])}}')">{{__('Show more')}}</a>
                @else
                    <a onClick="CommentsPaginator.loadResults({{$post->id}});" href="javascript:void(0);">{{__('Show more')}}</a>
                @endif
            </div>
            <div class="no-comments-label pl-3 d-none">
                {{__('No comments yet.')}}
            </div>
            @if(Auth::check())
                <hr>
                @include('elements.feed.post-new-comment')
            @endif
        </div>
    @endif

</div>