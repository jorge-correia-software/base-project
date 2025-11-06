@extends('layouts.app')

@section('content')

<section class="activities-page">
    <div class="activities-page-header">
        <div class="activities-page-container">
            <h1 class="activities-page-title">All Activities</h1>
            <p class="activities-page-description">Browse all upcoming activities and events designed to accelerate your business growth.</p>
        </div>
    </div>

    <div class="activities-page-container">
        <div class="activities-grid">
            @forelse($activities as $activity)
            <article class="activity-card">
                <div class="activity-card-image">
                    <img src="{{ $activity->image_url }}" alt="{{ $activity->name }}">
                    <div class="activity-card-image-overlay"></div>
                </div>
                <div class="activity-card-body">
                    <div class="activity-card-meta">
                        <span class="activity-badge">{{ $activity->company }}</span>
                        <time class="activity-date">{{ $activity->date->format('d M Y') }}</time>
                    </div>
                    <div class="activity-card-content">
                        <h3 class="activity-card-title">{{ $activity->name }}</h3>
                        <p class="activity-card-description">{{ Str::limit($activity->description, 100) }}</p>
                    </div>
                </div>
                <div class="activity-card-footer">
                    <div class="activity-footer-content">
                        <div class="activity-icon-wrapper">
                            @php
                                // Map React icon names to Material Icons
                                $iconMap = [
                                    'Briefcase' => 'work',
                                    'Rocket' => 'rocket_launch',
                                    'DollarSign' => 'attach_money',
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
                        <div class="activity-company-name">
                            <p>{{ $activity->company }}</p>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="activities-empty">
                <i class="material-icons-round">event_busy</i>
                <p>No upcoming activities at the moment. Check back soon!</p>
            </div>
            @endforelse
        </div>

        @if($activities->hasPages())
        <div class="activities-pagination">
            {{ $activities->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
