@extends('layouts.app')

@section('content')

<section class="support-page">
    <div class="support-page-header">
        <div class="support-page-container">
            <h1 class="support-page-title">Business Support</h1>
            <p class="support-page-description">Access expert guidance and resources across key business areas to help your company thrive and grow.</p>
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
