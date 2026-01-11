<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }}</title>
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

        @vite(['resources/scss/admin/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="admin-layout">
            @include('admin.top-panel')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>