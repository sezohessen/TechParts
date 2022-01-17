{{-- Nav --}}
<ul class="py-4 navi navi-hover">
    {{-- Item --}}
    <li class="navi-item">
        <a href="{{url('/lang/en')}}" class="navi-link @if (App::isLocale('en'))  active  @endif">
            <span class="mr-3 symbol symbol-20">
                <img src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt=""/>
            </span>
            <span class="navi-text">English</span>
        </a>
    </li>

    {{-- Item --}}
    <li class="navi-item">
        <a href="{{url('/lang/ar')}}" class="navi-link @if (App::isLocale('ar'))  active  @endif" href="{{url('/ar')}}">
            <span class="mr-3 symbol symbol-20">
                <img src="{{ asset('media/svg/flags/158-egypt.svg') }}" alt=""/>
            </span>
            <span class="navi-text">Arabic</span>
        </a>
    </li>
</ul>
