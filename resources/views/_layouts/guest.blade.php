<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">   

        <title>{{ config('app.name', 'WebSite') }}</title>

        @vite(['resources/scss/guest/app.scss', 'resources/js/guest/app.js'])
    </head>
    <body>
        <div class="guest-layout">
            @yield('content')
        </div>        
    </body>
</html>