@extends('layouts.app')

@section('content')

<section class="support-page">
    {{-- Hero Banner --}}
    <div class="activities-hero-banner support-hero-banner">
        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop"
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

    <div class="support-page-container">
        <div class="support-grid">
            @forelse($supportAreas as $area)
            <article class="support-card">
                <img src="{{ $area->image_url }}" alt="{{ $area->title }}" class="support-card-image">
                <div class="support-card-gradient"></div>
                <div class="support-card-ring"></div>
                <h3 class="support-card-title">{{ $area->title }}</h3>
                <p class="support-card-description">{{ $area->description }}</p>
            </article>
            @empty
            <div class="support-empty">
                <i class="material-icons-round">support</i>
                <p>No support areas available at the moment. Check back soon!</p>
            </div>
            @endforelse
        </div>

        @if($supportAreas->hasPages())
        <div class="support-pagination">
            {{ $supportAreas->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
