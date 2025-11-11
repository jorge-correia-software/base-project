<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $seo['description'] ?? 'BASE - Business Advice and Support for Entrepreneurs. Empowering Business Growth in Scotland.' }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? 'business support, scotland, grants, funding, business growth' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title>{{ $seo['title'] ?? 'BASE - Business Advice and Support for Entrepreneurs' }}</title>
    <meta property="og:title" content="{{ $seo['og_title'] ?? $seo['title'] ?? 'BASE Scotland' }}">
    <meta property="og:description" content="{{ $seo['og_description'] ?? $seo['description'] ?? 'Empowering Business Growth in Scotland' }}">
    <meta property="og:image" content="{{ $seo['og_image'] ?? asset('img/og-image.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <x-frontend.navbar />

    <main>
        @yield('content')
    </main>

    <x-frontend.footer />

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>

    @stack('scripts')
</body>
</html>
