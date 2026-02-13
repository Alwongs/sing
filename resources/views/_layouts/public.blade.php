<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WebSite') }}</title>

        @vite(['resources/scss/public/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="public-layout">
            @include('public.top-panel')

            <div class="content-wrapper">
                <div class="container flex-container flex-center-start">
                    @include('public.aside-left')

                    <main class="main">
                        @yield('content')
                    </main>

                    @include('public.aside-right')
                </div>
            </div>

            @include('public.footer')
        </div>        
    </body>
</html>
