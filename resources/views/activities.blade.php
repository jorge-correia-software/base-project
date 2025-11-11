@extends('layouts.app')

@section('content')

<section class="activities-page">
    {{-- Hero Banner --}}
    <div class="activities-hero-banner">
        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop"
             alt="People collaborating in a modern office space"
             class="hero-banner-image">
        <div class="hero-banner-overlay"></div>
        <div class="hero-banner-content">
            <div class="activities-page-container">
                <div class="hero-badge">
                    <div class="hero-icon-wrapper">
                        <i class="material-icons-round">explore</i>
                    </div>
                    <span class="hero-badge-text">Explore & Learn</span>
                </div>
                <h1 class="hero-title">Discover Our Full Range of Business Activities</h1>
                <p class="hero-subtitle">From financial workshops to marketing masterclasses, find the perfect opportunity to accelerate your business growth and connect with industry experts.</p>
            </div>
        </div>
    </div>

    <div class="activities-page-container">
        {{-- Filter Header --}}
        <div class="filter-header">
            <h2 class="filter-title">All Activities</h2>
            <button id="filter-toggle" class="filter-toggle-btn" aria-label="Toggle filters">
                <i class="material-icons-round">tune</i>
            </button>
        </div>

        {{-- Collapsible Filter Panel --}}
        <div id="filter-panel" class="filter-panel" style="display: none;">
            <form method="GET" action="{{ route('activities') }}" class="filter-form">
                <div class="filter-grid">
                    {{-- Search Input --}}
                    <div class="filter-group">
                        <label for="search" class="filter-label">Search</label>
                        <input type="text"
                               id="search"
                               name="search"
                               class="filter-input"
                               placeholder="Search activities..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- Sort Dropdown --}}
                    <div class="filter-group">
                        <label for="sort" class="filter-label">Sort By</label>
                        <select id="sort" name="sort" class="filter-select">
                            <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Date</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        </select>
                    </div>

                    {{-- Company Filter --}}
                    <div class="filter-group">
                        <label for="filter" class="filter-label">Company</label>
                        <select id="filter" name="filter" class="filter-select">
                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Companies</option>
                            <option value="brt" {{ request('filter') == 'brt' ? 'selected' : '' }}>BRT</option>
                            <option value="elevator" {{ request('filter') == 'elevator' ? 'selected' : '' }}>Elevator</option>
                        </select>
                    </div>

                    {{-- Items Per Page --}}
                    <div class="filter-group">
                        <label for="per_page" class="filter-label">Items Per Page</label>
                        <select id="per_page" name="per_page" class="filter-select">
                            <option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>6</option>
                            <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12</option>
                            <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>
                        </select>
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter-apply">Apply Filters</button>
                    <a href="{{ route('activities') }}" class="btn-filter-reset">Reset</a>
                </div>
            </form>
        </div>

        {{-- Activities Grid --}}
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

        {{-- Pagination --}}
        @if($activities->hasPages())
        <div class="activities-pagination">
            {{ $activities->links() }}
        </div>
        @endif
    </div>
</section>

<script>
// Filter toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('filter-toggle');
    const filterPanel = document.getElementById('filter-panel');

    if (filterToggle && filterPanel) {
        filterToggle.addEventListener('click', function() {
            if (filterPanel.style.display === 'none') {
                filterPanel.style.display = 'block';
            } else {
                filterPanel.style.display = 'none';
            }
        });
    }
});
</script>

@endsection
