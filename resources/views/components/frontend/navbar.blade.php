@php
    $isHomepage = request()->is('/');
    $currentRoute = Route::currentRouteName();
@endphp

<header id="mainNav" class="navbar-transparent {{ !$isHomepage ? 'navbar-other-page' : '' }} fixed inset-x-0 top-0 z-50 transition-all duration-300">
    <nav class="flex items-center justify-between p-4 sm:p-5 md:p-6 lg:px-8" aria-label="Global">
        {{-- Logo --}}
        <div class="flex lg:flex-1">
            @if($isHomepage)
                <a href="#" class="-m-1.5 p-1.5" data-scroll-to="hero">
                    <img id="navbar-logo" src="{{ asset('img/logo_pink.png') }}" alt="BASE Logo" class="h-8 sm:h-9 md:h-10 w-auto">
                </a>
            @else
                <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                    <img id="navbar-logo" src="{{ asset('img/logo_pink.png') }}" alt="BASE Logo" class="h-8 sm:h-9 md:h-10 w-auto">
                </a>
            @endif
        </div>

        {{-- Mobile menu button --}}
        <div class="flex lg:hidden">
            <button type="button" id="mobile-menu-button" class="mobile-menu-button -m-2.5 inline-flex items-center justify-center rounded-md p-2.5 min-w-[44px] min-h-[44px] mobile-menu-toggle">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        {{-- Desktop navigation links --}}
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="{{ $isHomepage ? '#' : route('home') }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink {{ $currentRoute === 'home' ? 'active' : '' }}" @if($isHomepage) data-scroll-to="hero" @endif>Home</a>
            <a href="{{ $isHomepage ? '#about' : route('home') . '#about' }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" @if($isHomepage) data-scroll-to="about" @endif>About</a>
            <a href="{{ $isHomepage ? '#partners' : route('home') . '#partners' }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" @if($isHomepage) data-scroll-to="partners" @endif>Partners</a>
            <a href="{{ $isHomepage ? '#activities' : route('home') . '#activities' }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink {{ $currentRoute === 'activities' ? 'active' : '' }}" @if($isHomepage) data-scroll-to="activities" @endif>Activities</a>
            <a href="{{ $isHomepage ? '#support' : route('home') . '#support' }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink {{ $currentRoute === 'support' ? 'active' : '' }}" @if($isHomepage) data-scroll-to="support" @endif>Support</a>
            <a href="{{ $isHomepage ? '#news' : route('home') . '#news' }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink {{ $currentRoute === 'highlights' ? 'active' : '' }}" @if($isHomepage) data-scroll-to="news" @endif>Highlights</a>
            <a href="{{ $isHomepage ? '#contact' : route('home') . '#contact' }}" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" @if($isHomepage) data-scroll-to="contact" @endif>Contact</a>
        </div>

        {{-- Get Started button (desktop) --}}
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a href="{{ $isHomepage ? '#contact' : route('home') . '#contact' }}" class="btn-get-started rounded-full px-4 sm:px-5 md:px-6 py-2 sm:py-2.5 text-sm lg:text-base font-semibold shadow-lg transition-all duration-300 hover:scale-105 bg-brand-yellow text-gray-900 hover:bg-brand-yellow-hover" @if($isHomepage) data-scroll-to="contact" @endif>
                Get Started
            </a>
        </div>
    </nav>
</header>

{{-- Mobile menu --}}
<div id="mobile-menu" class="lg:hidden hidden">
    {{-- Overlay --}}
    <div class="fixed inset-0 z-[100] bg-black/50 mobile-menu-overlay"></div>

    {{-- Slide-in panel --}}
    <div class="fixed inset-y-0 right-0 z-[100] w-full overflow-y-auto bg-white px-4 py-4 sm:px-6 sm:py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        {{-- Mobile menu header --}}
        <div class="flex items-center justify-between">
            @if($isHomepage)
                <a href="#" class="-m-1.5 p-1.5" data-scroll-to="hero">
                    <img src="{{ asset('img/logo_pink.png') }}" alt="BASE Logo" class="h-8 sm:h-10 w-auto">
                </a>
            @else
                <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                    <img src="{{ asset('img/logo_pink.png') }}" alt="BASE Logo" class="h-8 sm:h-10 w-auto">
                </a>
            @endif
            <button type="button" class="mobile-menu-close-button -m-2.5 rounded-md p-2.5 mobile-menu-close">
                <span class="sr-only">Close menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Mobile menu content --}}
        <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
                {{-- Navigation links --}}
                <div class="space-y-2 py-6">
                    <a href="{{ $isHomepage ? '#' : route('home') }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300 {{ $currentRoute === 'home' ? 'active text-brand-pink bg-gray-50' : '' }}" @if($isHomepage) data-scroll-to="hero" @endif>Home</a>
                    <a href="{{ $isHomepage ? '#about' : route('home') . '#about' }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" @if($isHomepage) data-scroll-to="about" @endif>About</a>
                    <a href="{{ $isHomepage ? '#partners' : route('home') . '#partners' }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" @if($isHomepage) data-scroll-to="partners" @endif>Partners</a>
                    <a href="{{ $isHomepage ? '#activities' : route('home') . '#activities' }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300 {{ $currentRoute === 'activities' ? 'active text-brand-pink bg-gray-50' : '' }}" @if($isHomepage) data-scroll-to="activities" @endif>Activities</a>
                    <a href="{{ $isHomepage ? '#support' : route('home') . '#support' }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300 {{ $currentRoute === 'support' ? 'active text-brand-pink bg-gray-50' : '' }}" @if($isHomepage) data-scroll-to="support" @endif>Support</a>
                    <a href="{{ $isHomepage ? '#news' : route('home') . '#news' }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300 {{ $currentRoute === 'highlights' ? 'active text-brand-pink bg-gray-50' : '' }}" @if($isHomepage) data-scroll-to="news" @endif>Highlights</a>
                    <a href="{{ $isHomepage ? '#contact' : route('home') . '#contact' }}" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" @if($isHomepage) data-scroll-to="contact" @endif>Contact</a>
                </div>

                {{-- Get Started button (mobile) --}}
                <div class="py-6">
                    <a href="{{ $isHomepage ? '#contact' : route('home') . '#contact' }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50" @if($isHomepage) data-scroll-to="contact" @endif>Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>
