<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }}</title>

        @vite(['resources/scss/admin/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="admin-layout">
            @include('admin.aside')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>