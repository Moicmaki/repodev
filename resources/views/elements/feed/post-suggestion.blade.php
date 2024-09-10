<div class="post-box" data-postid="{{ $post->id }}">


    <div class="post-header pl-3 pr-3">
        <div class="d-flex">
            <div class="avatar-wrapper">
                @if($post->avatar)
                <img class="avatar rounded-circle" src="{{ asset('storage/' . $post->avatar) }}"
                    alt="{{ $post->username }}'s avatar">
                @else
                <img class="avatar rounded-circle"
                    src="https://eclypx.fr/storage/users/avatar/fe28fa581f344518a69092813b1bc7ba.png"
                    alt="{{ $post->username }}'s default avatar">
                @endif
            </div>
            <div class="post-details pl-2 w-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-bold">
                            <a href="{{ $post->username }}" class="text-white d-flex">
                                {{ $post->username }}

                                @if(Auth::check() && $post->user_id === Auth::user()->id && $post->price > 0)
                                <div class="pr-3 pr-md-3 ml-2"><span
                                        class="badge badge-pill bg-gradient-faded-primary">{{ucfirst(__("PPV"))}}</span>
                                </div>
                                @endif

                            </a>
                        </div>
                        <div>
                            <a href="{{ $post->username }}" class="text-white text-hover">
                                <span>@</span>{{ $post->username }}
                            </a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="pr-3 pr-md-3">
                            <a class="text-white text-hover d-flex" href="{{ $post->username }}">
                                {{ $post->created_at }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="post-content mt-3">

        <div class="post-media">
            <div class="pointer-cursor-hidden llna">

                @if($post->publication_gratuite == 1)


                @if($post->attachment_filename)
                @if(Str::endsWith($post->attachment_filename, ['.jpg', '.jpeg', '.png', '.gif']))
                <img src="{{ asset('storage/' . $post->attachment_filename) }}" alt="Image Attachment"
                    class="img-fluid blur img-fluid rounded-0 w-100">
                @elseif(Str::endsWith($post->attachment_filename, ['.mp4', '.mov', '.avi']))

                <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                    <video class="video-preview w-100"
                    src="{{ asset('storage/' . $post->attachment_filename) }}"></video>
                </div>
                @else
                @endif
                @endif

                @else


                @if($post->attachment_filename)
                @if(Str::endsWith($post->attachment_filename, ['.jpg', '.jpeg', '.png', '.gif']))
                <img src="{{ asset('storage/' . $post->attachment_filename) }}" alt="Image Attachment"
                    class="img-fluid blur img-fluid rounded-0 w-100" style="filter: blur(40px) !important;">
                @elseif(Str::endsWith($post->attachment_filename, ['.mp4', '.mov', '.avi']))

                <div class="video-wrapper h-100 w-100 d-flex justify-content-center align-items-center">
                    <a href="#">
                        <video style="filter: blur(40px) !important;" class="video-preview w-100"
                            src="{{ asset('storage/' . $post->attachment_filename) }}"></video>
                    </a>
                </div>
                @else
                @endif
                @endif


                <div class="visit_middle">
                    <img src="{{asset('/img/filigrane.png')}}" alt="filigrane" class="filigrane">


                    <div>
                    <a href="{{ $post->username }}" class="btn btn-primary mb-1">
                            {{__('Subscribe')}} 
                            {{__('for')}}
                            {{trans_choice('days', 30, ['number'=>30])}}
                     </a>
                            

                    @if($post->price > 0)
                    <a href="{{ $post->username }}" class="btn btn-primary">
                        Déverrouiller le post pour {{ $post->price }}€
                    </a>
                    @endif
                    </div>
                </div>



                @endif




            </div>
            <div class="px-3 px-md-0">
            </div>

        </div>

        <div class="post-footer mt-3 pl-3 pr-3">
            <div class="footer-actions d-flex justify-content-between">
                <div class="d-flex">
                    <div class="h-pill h-pill-primary mr-1 rounded react-button" data-toggle="tooltip"
                        data-placement="top" title="J'aime" onclick="{{ $post->username }}">
                        <div class="ion-icon-wrapper icon-medium d-flex justify-content-center align-items-center">
                            <div class="ion-icon-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                    <path
                                        d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-pill h-pill-primary mr-1 rounded" data-toggle="tooltip" data-placement="top"
                        title="Afficher les commentaires" onclick="{{ $post->username }}">
                        <div class="ion-icon-wrapper icon-medium d-flex justify-content-center align-items-center">
                            <div class="ion-icon-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                    <path
                                        d="M87.49 380c1.19-4.38-1.44-10.47-3.95-14.86a44.86 44.86 0 00-2.54-3.8 199.81 199.81 0 01-33-110C47.65 139.09 140.73 48 255.83 48 356.21 48 440 117.54 459.58 209.85a199 199 0 014.42 41.64c0 112.41-89.49 204.93-204.59 204.93-18.3 0-43-4.6-56.47-8.37s-26.92-8.77-30.39-10.11a31.09 31.09 0 00-11.12-2.07 30.71 30.71 0 00-12.09 2.43l-67.83 24.48a16 16 0 01-4.67 1.22 9.6 9.6 0 01-9.57-9.74 15.85 15.85 0 01.6-3.29z"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="32"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-pill h-pill-primary send-a-tip to-tooltip poi" data-toggle="modal"
                        data-target="#checkout-center" data-post-id="postId" data-type="tip" data-first-name="firstName"
                        data-last-name="lastName" data-billing-address="billingAddress" data-country="country"
                        data-city="city" data-state="state" data-postcode="postcode"
                        data-available-credit="availableCredit" data-username="username" data-name="name"
                        data-avatar="avatarUrl" data-recipient-id="recipientId">
                        <div class="d-flex align-items-center">
                            <div class="ion-icon-wrapper icon-medium d-flex justify-content-center align-items-center">
                                <div class="ion-icon-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                        <path d="M256 104v56h56a56 56 0 10-56-56zM256 104v56h-56a56 56 0 1156-56z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-miterlimit="10" stroke-width="32"></path>
                                        <rect x="64" y="160" width="384" height="112" rx="32" ry="32" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="32"></rect>
                                        <path d="M416 272v144a48 48 0 01-48 48H144a48 48 0 01-48-48V272M256 160v304"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1 d-none d-lg-block">Envoyer un pourboire</div>
                        </div>
                    </div>
                </div>
                <div class="mt-0 d-flex align-items-center justify-content-center post-count-details">
                    <span class="ml-2-h">
                        <strong class="text-bold post-reactions-label-count">0</strong>
                        <span class="post-reactions-label">aimes</span>
                    </span>
                    <span class="ml-2-h d-none d-lg-block">
                        <a href="{{ $post->username }}" class="text-white text-hover">
                            <strong class="post-comments-label-count">0</strong>
                            <span class="post-comments-label">commentaires</span>
                        </a>
                    </span>
                    <span class="ml-2-h d-none d-lg-block">
                        <strong class="post-tips-label-count">0</strong>
                        <span class="post-tips-label">pourboires</span>
                    </span>
                </div>
            </div>
        </div>


    </div>



</div>

<hr>