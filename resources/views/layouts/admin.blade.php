<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>{{ config('app.name', 'BASE') }} - @yield('title', 'Dashboard')</title>

    <x-admin.head-assets />

    @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100" style="padding-top: 50px;">

    <x-admin.navbar />

    <x-admin.sidebar />

    <main class="main-content position-relative border-radius-lg d-flex flex-column" style="min-height: calc(100vh - 50px);">

        <div class="container-fluid px-3 pt-4">
            @yield('content')
        </div>

        <x-admin.footer />
    </main>

    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>

    <x-admin.footer-assets />

    <script src="{{ asset('js/chart-defaults.js') }}"></script>

    @stack('scripts')
</body>
</html>
