<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vaste') }} - @yield('title', 'Welcome')</title>

    <x-admin.head-assets />

    <style>
        /* Add border to auth form cards only */
        .card-plain {
            border: 1px solid #e0e0e0 !important;
        }

        /* Kill ALL Material Dashboard checkbox styling */
        .form-check-input[type="checkbox"],
        .form-check-input[type="checkbox"]::before,
        .form-check-input[type="checkbox"]::after {
            all: unset !important;
        }

        .form-check-input[type="checkbox"] {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            width: 20px !important;
            height: 20px !important;
            cursor: pointer !important;
            vertical-align: middle !important;
            margin-top: 0 !important;
            margin-right: 8px !important;
            border: 1px solid #d2d6da !important;
            border-radius: 0.35rem !important;
            background-color: white !important;
            transition: all 0.3s ease !important;
            display: inline-block !important;
        }

        .form-check-input[type="checkbox"]:checked {
            background-color: #e91e63 !important;
            border-color: #e91e63 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e") !important;
            background-size: 100% !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }
    </style>

    @stack('styles')
</head>
<body class="">

    <main class="main-content mt-0">
        @yield('content')
    </main>

    <x-admin.footer-assets />

    @stack('scripts')
</body>
</html>
