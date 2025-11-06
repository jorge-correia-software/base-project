@extends('layouts.app')

@section('content')

<section class="highlights-page">
    <div class="highlights-page-header">
        <div class="highlights-page-container">
            <h1 class="highlights-page-title">Highlights & Success Stories</h1>
            <p class="highlights-page-description">Stay updated with the latest highlights, events, and inspiring success stories from our business community.</p>
        </div>
    </div>

    <div class="highlights-page-container">
        <div class="highlights-grid">
            @forelse($highlights as $highlight)
            <article class="highlight-card">
                <div class="highlight-card-image">
                    <img src="{{ $highlight->image_url }}" alt="{{ $highlight->title }}">
                    <div class="highlight-card-image-overlay"></div>
                </div>
                <div class="highlight-card-body">
                    <div class="highlight-card-meta">
                        <span class="highlight-badge">{{ $highlight->category }}</span>
                        <time class="highlight-date">{{ $highlight->date->format('d M Y') }}</time>
                    </div>
                    <div class="highlight-card-content">
                        <h3 class="highlight-card-title">{{ $highlight->title }}</h3>
                        <p class="highlight-card-description">{{ Str::limit($highlight->description, 100) }}</p>
                    </div>
                </div>
                <div class="highlight-card-footer">
                    <div class="highlight-footer-content">
                        <img src="{{ $highlight->author_avatar }}" alt="{{ $highlight->author_name }}" class="highlight-author-avatar">
                        <div class="highlight-author-name">
                            <p>{{ $highlight->author_name }}</p>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="highlights-empty">
                <i class="material-icons-round">stars</i>
                <p>No highlights available at the moment. Check back soon!</p>
            </div>
            @endforelse
        </div>

        @if($highlights->hasPages())
        <div class="highlights-pagination">
            {{ $highlights->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
