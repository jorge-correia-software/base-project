@extends('layouts.app')

@section('content')

<section class="support-page">
    {{-- Hero Banner --}}
    <div class="activities-hero-banner support-hero-banner">
        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=2070&auto=format&fit=crop"
             alt="Business professionals collaborating and receiving expert support"
             class="hero-banner-image">
        <div class="hero-banner-overlay"></div>
        <div class="hero-banner-content">
            <div class="activities-page-container">
                <div class="hero-badge">
                    <div class="hero-icon-wrapper">
                        <i class="material-icons-round">handshake</i>
                    </div>
                    <span class="hero-badge-text">Expert Support</span>
                </div>
                <h1 class="hero-title">Comprehensive Business Support Services</h1>
                <p class="hero-subtitle">From financial guidance to innovation vouchers, access expert support and resources tailored to help your business thrive at every stage of growth.</p>
            </div>
        </div>
    </div>

    {{-- Featured Support Sections --}}
    @foreach($supportAreas as $index => $area)
    <section class="support-feature-section {{ $index === 1 ? 'bg-gray' : '' }}">
        <div class="support-feature-container {{ $index === 1 ? 'image-right' : '' }}">
            <div class="support-feature-image">
                <img src="{{ asset($area->featured_image) }}" alt="{{ $area->title }}">
            </div>
            <div class="support-feature-content">
                <h2 class="support-feature-title">{{ $area->title }}</h2>
                <p class="support-feature-text">{!! $area->description !!}</p>
                <p class="support-feature-text">{!! $area->content !!}</p>
            </div>
        </div>
    </section>
    @endforeach
</section>

@endsection
