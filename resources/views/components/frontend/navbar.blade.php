<header id="mainNav" class="navbar-transparent fixed inset-x-0 top-0 z-50 transition-all duration-300">
    <nav class="flex items-center justify-between p-4 sm:p-5 md:p-6 lg:px-8" aria-label="Global">
        {{-- Logo --}}
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5" data-scroll-to="hero">
                <img id="navbar-logo" src="{{ asset('img/logo_pink.png') }}" alt="BASE Logo" class="h-8 sm:h-9 md:h-10 w-auto">
            </a>
        </div>

        {{-- Mobile menu button --}}
        <div class="flex lg:hidden">
            <button type="button" id="mobile-menu-button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 min-w-[44px] min-h-[44px] text-gray-900 mobile-menu-toggle">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        {{-- Desktop navigation links --}}
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="#" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="hero">Home</a>
            <a href="#about" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="about">About</a>
            <a href="#partners" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="partners">Partners</a>
            <a href="#activities" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="activities">Activities</a>
            <a href="#support" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="support">Support</a>
            <a href="#news" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="news">Highlights</a>
            <a href="#contact" class="nav-link text-sm lg:text-base xl:text-lg font-semibold leading-6 transition-all duration-300 text-gray-900 hover:text-brand-pink" data-scroll-to="contact">Contact</a>
        </div>

        {{-- Get Started button (desktop) --}}
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a href="#contact" class="btn-get-started rounded-full px-4 sm:px-5 md:px-6 py-2 sm:py-2.5 text-sm lg:text-base font-semibold shadow-lg transition-all duration-300 hover:scale-105 bg-brand-yellow text-gray-900 hover:bg-brand-yellow-hover" data-scroll-to="contact">
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
            <a href="#" class="-m-1.5 p-1.5" data-scroll-to="hero">
                <img src="{{ asset('img/logo_pink.png') }}" alt="BASE Logo" class="h-8 sm:h-10 w-auto">
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700 mobile-menu-close">
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
                    <a href="#" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="hero">Home</a>
                    <a href="#about" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="about">About</a>
                    <a href="#partners" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="partners">Partners</a>
                    <a href="#activities" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="activities">Activities</a>
                    <a href="#support" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="support">Support</a>
                    <a href="#news" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="news">Highlights</a>
                    <a href="#contact" class="mobile-nav-link -mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 transition-all duration-300" data-scroll-to="contact">Contact</a>
                </div>

                {{-- Get Started button (mobile) --}}
                <div class="py-6">
                    <a href="#contact" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50" data-scroll-to="contact">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>
