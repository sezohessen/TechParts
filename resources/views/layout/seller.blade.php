<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }}
    {{ Metronic::printClasses('html') }} @if (App::isLocale('ar')) direction="rtl"
dir="rtl" style="direction: rtl" @endif>

<head>
    <meta charset="utf-8" />

    {{-- Title Section --}}
    <title> {{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach (config('layout.resources.css') as $style)
        <link href="{{ App::isLocale('ar') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet"
            type="text/css" />
    @endforeach


    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
        <link href="{{ App::isLocale('ar') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet"
            type="text/css" />
    @endforeach

    {{-- Includable CSS --}}
    @yield('styles')
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

    @if (config('layout.page-loader.type') != '')
        @include('layout.partials._page-loader')
    @endif

    @include('layout.seller._layout')


    {{-- Global Config (global config for global JS scripts)
    --}}
    <script>
        var KTAppSettings = {
            !!json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!
        };

    </script>

    {{-- Global Theme JS Bundle (used by all pages) --}}
    @foreach (config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{-- Includable JS --}}
    @yield('scripts')

</body>

</html>
