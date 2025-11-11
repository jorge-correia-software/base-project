@extends('layouts.app')

@section('content')

<section class="activities-page">
    {{-- Hero Banner --}}
    <div class="activities-hero-banner">
        <img src="{{ $activity->image_url }}"
             alt="{{ $activity->name }}"
             class="hero-banner-image">
        <div class="hero-banner-overlay"></div>
        <div class="hero-banner-content">
            <div class="activities-page-container">
                <div class="hero-badge">
                    <div class="hero-icon-wrapper">
                        @php
                            $iconMap = [
                                'Briefcase' => 'work',
                                'Rocket' => 'rocket_launch',
                                'DollarSign' => 'currency_pound',
                                'Users' => 'people',
                                'Target' => 'track_changes',
                                'PenTool' => 'edit',
                                'Brain' => 'psychology',
                                'Coffee' => 'local_cafe',
                                'Clock' => 'schedule',
                                'Lightbulb' => 'lightbulb',
                                'Globe' => 'public',
                                'Leaf' => 'eco',
                                'Calendar' => 'event',
                            ];
                            $materialIcon = $iconMap[$activity->icon] ?? 'event';
                        @endphp
                        <i class="material-icons-round">{{ $materialIcon }}</i>
                    </div>
                    <span class="hero-badge-text">{{ $activity->company }}</span>
                </div>

                <h1 class="hero-title">{{ $activity->name }}</h1>
                <p class="hero-subtitle">{{ Str::limit($activity->description, 150) }}</p>

                <div class="hero-meta-info">
                    <div class="hero-meta-item">
                        <i class="material-icons-round">event</i>
                        <span>{{ $activity->date->format('d M Y') }}</span>
                    </div>

                    @if($activity->duration)
                    <div class="hero-meta-item">
                        <i class="material-icons-round">schedule</i>
                        <span>{{ $activity->duration }}</span>
                    </div>
                    @endif

                    @if($activity->location)
                    <div class="hero-meta-item">
                        <i class="material-icons-round">location_on</i>
                        <span>{{ $activity->location }}</span>
                    </div>
                    @endif

                    <div class="hero-meta-item">
                        <i class="material-icons-round">currency_pound</i>
                        <span>{{ $activity->price && strtolower($activity->price) !== 'free' ? $activity->price : 'Free' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Content --}}
    <div class="activities-page-container">
        <div class="activity-content-section">
            <h2 class="activity-content-heading">About This Activity</h2>
            <p class="activity-content-text">{{ $activity->description }}</p>
        </div>
    </div>

    {{-- Related Activities --}}
    @if($relatedActivities->count() > 0)
    <div class="related-activities-section">
        <div class="activities-page-container">
            <div class="related-activities-header">
                <h3 class="related-activities-title">More from {{ $activity->company }}</h3>
            </div>

            <div class="activities-grid">
            @foreach($relatedActivities as $relatedActivity)
            <article class="activity-card">
                <a href="{{ route('activities.show', $relatedActivity->id) }}" class="activity-card-link">
                    <div class="activity-card-image">
                        <img src="{{ $relatedActivity->image_url }}" alt="{{ $relatedActivity->name }}">
                        <div class="activity-card-image-overlay"></div>

                        {{-- Price Pill --}}
                        <div class="activity-price-pill">
                            @if($relatedActivity->price && strtolower($relatedActivity->price) !== 'free')
                                {{ $relatedActivity->price }}
                            @else
                                Free
                            @endif
                        </div>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-meta">
                            <span class="activity-badge">{{ $relatedActivity->company }}</span>
                            <time class="activity-date">{{ $relatedActivity->date->format('d M Y') }}</time>
                        </div>
                        <div class="activity-card-content">
                            <h3 class="activity-card-title">{{ $relatedActivity->name }}</h3>
                            <p class="activity-card-description">{{ Str::limit($relatedActivity->description, 100) }}</p>
                        </div>

                        {{-- Time and Location Meta --}}
                        <div class="activity-body-meta">
                            @if($relatedActivity->duration)
                            <div class="activity-meta-item">
                                <i class="material-icons-round">schedule</i>
                                <span>{{ $relatedActivity->duration }}</span>
                            </div>
                            @endif

                            @if($relatedActivity->location)
                            <div class="activity-meta-item">
                                <i class="material-icons-round">location_on</i>
                                <span>{{ $relatedActivity->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="activity-card-footer">
                        <div class="activity-footer-content">
                            <div class="activity-icon-wrapper">
                                @php
                                    $iconMap = [
                                        'Briefcase' => 'work',
                                        'Rocket' => 'rocket_launch',
                                        'DollarSign' => 'currency_pound',
                                        'Users' => 'people',
                                        'Target' => 'track_changes',
                                        'PenTool' => 'edit',
                                        'Brain' => 'psychology',
                                        'Coffee' => 'local_cafe',
                                        'Clock' => 'schedule',
                                        'Lightbulb' => 'lightbulb',
                                        'Globe' => 'public',
                                        'Leaf' => 'eco',
                                        'Calendar' => 'event',
                                    ];
                                    $materialIcon = $iconMap[$relatedActivity->icon] ?? 'event';
                                @endphp
                                <i class="material-icons-round">{{ $materialIcon }}</i>
                            </div>
                            <div class="activity-company-name">
                                <p>{{ $relatedActivity->company }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
            </div>
        </div>
    </div>
    @endif
</section>

<style>
/* Activity-Specific Styles */

/* Back Button */
.activity-back-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 9999px;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 300ms ease;
    margin-bottom: 2rem;
}

.activity-back-button:hover {
    background-color: rgba(255, 255, 255, 0.3);
    color: white;
    border-color: rgba(255, 255, 255, 0.5);
}

.activity-back-button .material-icons-round {
    font-size: 18px;
}

/* Hero Subtitle Spacing */
.activities-page .hero-subtitle {
    margin-bottom: 1.5rem;
}

/* Hero Meta Info (Date, Time, Location, Price) */
.hero-meta-info {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1.5rem;
}

.hero-meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    font-weight: 500;
}

.hero-meta-item .material-icons-round {
    font-size: 20px;
    color: #FFD700; /* Yellow accent */
}

/* Activity Content Section */
.activity-content-section {
    padding: 3rem 0;
}

.activity-content-heading {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 1.5rem;
}

.activity-content-text {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #4a5568;
    white-space: pre-line;
}

/* Related Activities Section */
.related-activities-section {
    padding: 4rem 0;
    margin-top: 3rem;
}

.related-activities-header {
    margin-bottom: 2rem;
}

.related-activities-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1a202c;
}
</style>

@endsection
