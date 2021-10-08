@extends('website.layouts.app')
@include('Chatify::layouts.headLinks')
@section('website')
<div class="mt-32 messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="sm:hidden messenger-listView sm:relative">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"> <span class="messenger-headTitle">@lang('MESSAGES')</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="p-1 messenger-search" placeholder="@lang('Search')" />
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a href="#" @if($route == 'user') class="active-tab" @endif data-view="users">
                 @lang('Your messages') <span class="far fa-user"></span> </a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body">
        {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="- messenger-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title">@lang('Search')</p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>@lang('Type to search..')</span></p>
                </div>
             </div>
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="@if($route == 'user') show @endif messenger-tab app-scroll" data-view="users">

               {{-- Favorites --}}
               <div class="favorites-section">
                <p class="messenger-title">@lang('Favorites')</p>
                <div class="messenger-favorites app-scroll-thin"></div>
               </div>

               {{-- Saved Messages --}}
               {!! view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render() !!}

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

           </div>


        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="max-h-screen bg-gray-100 sm:relative messenger-messagingView messenger-mob sm:z-50 sm:h-5/5 sm:mt-36" style="max-height: 680px;">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav>
                {{-- header back button, avatar and user name --}}
                <div style="display: inline-flex;">
                    <a href="#"
                    class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    {{-- @php
                        if($id){
                            $userId = explode('_',$id);
                            $user   = App\Models\User::find($userId[1]);
                        }
                    @endphp
                    @if ($id)
                        <a href= "{{ route('Website.SellerProfile',['id'=>$user->id,'first'=>$user->first_name,'second'=>$user->last_name]) }}" class="user-name">{{ config('chatify.name') }}</a>
                    @else

                    @endif --}}
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <!-- Seller page HOME ICON -->
                    {{-- @if ($id)
                        <a href="{{ route('Website.SellerProfile',['id'=>$user->id,'first'=>$user->first_name,'second'=>$user->last_name]) }}" class="show-infoSide"><i class="fas fa-home"></i></a>
                    @else
                        <a href="#" class="show-infoSide"><i class="fas fa-home"></i></a>
                    @endif --}}
                    <a href="#" class="show-infoSide sm:hidden"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
        </div>
        {{-- Internet connection --}}
        <div class="internet-connection">
            <span class="ic-connected">@lang('Connected')</span>
            <span class="ic-connecting">@lang('Connecting')</span>
            <span class="ic-noInternet">@lang('No internet access')</span>
        </div>
        {{-- Messaging area --}}
        <div class="m-body app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>@lang('Please select a chat to start messaging')</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </p>
                </div>
            </div>
            {{-- Send Message Form --}}
            @include('Chatify::layouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll sm:z-50 sm:absolute sm:mt-32 sm:h-full">
        {{-- nav actions --}}
        <nav>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')

@endsection
