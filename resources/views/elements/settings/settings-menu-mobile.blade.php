<div class="mt-3 inline-border-tabs text-bold">
    <nav class="nav nav-pills nav-justified nav_is_mobile_hack">
        @foreach($availableSettings as $route => $setting)
        <a class="nav-item nav-link nav_mobile_{{ \Illuminate\Support\Str::slug($route) }} {{$activeSettingsTab == $route ? 'active' : ''}}" href="{{route('my.settings',['type'=>$route])}}">
            <div class="d-flex justify-content-center">
                @include('elements.icon',['icon'=>\Illuminate\Support\Str::slug($setting['icon'].'-outline'),'centered'=>'false','variant'=>'medium'])
            </div>
        </a>
        @endforeach
    </nav>
</div>
