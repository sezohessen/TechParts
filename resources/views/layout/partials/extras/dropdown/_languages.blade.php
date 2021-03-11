{{-- Nav --}}
<ul class="navi navi-hover py-4">
    {{-- Item
    <li class="navi-item">
        <a href="{{url('/lang/en')}}" class="navi-link @if (App::isLocale('en'))  active  @endif">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt=""/>
            </span>
            <span class="navi-text">English</span>
        </a>
    </li>
    --}}

    {{-- Item --}}
    <li class="navi-item">
        <a href="{{url('/lang/ar')}}" class="navi-link @if (App::isLocale('ar'))  active  @endif" href="{{url('/ar')}}">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/133-saudi-arabia.svg') }}" alt=""/>
            </span>
            <span class="navi-text">Arabic</span>
        </a>
    </li>
</ul>
