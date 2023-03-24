<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Fonts and icons -->

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <!-- Nucleo Icons -->

    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('admin.layouts.aside-left')

    <!-- Page Content -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('admin.layouts.navbar-right')
        @yield('content')
        @include('admin.layouts.footer')
    </main>
    <!-- Page Content -->

    <!-- Fixed Plugin -->
    {{-- @include('admin.layouts.fixed-plugin') --}}
    <!-- Fixed Plugin -->

    @stack('modals')
    @include('admin.layouts.scripts.scripts')
    @livewireScripts
</body>

</html>
