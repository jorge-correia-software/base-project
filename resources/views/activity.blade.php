@extends('layouts.app')

@section('content')

<section class="activities-page activity-detail-page">
    {{-- Hero Banner (UNCHANGED) --}}
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

    {{-- Main Content Area --}}
    <div class="activities-page-container">
        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="material-icons-round" style="font-size: 18px; vertical-align: middle;">check_circle</i></strong>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Back to Activities Link --}}
        <div class="activity-back-link-wrapper">
            <a href="{{ route('activities') }}" class="activity-back-link">
                <i class="material-icons-round">arrow_back</i>
                <span>Back to activities</span>
            </a>
        </div>

        {{-- Single White Card with Two Column Layout --}}
        <div class="activity-detail-card">
            <div class="row g-4">
                {{-- Left Column: Main Content --}}
                <div class="col-lg-8">
                    {{-- About This Activity --}}
                    <div class="activity-content-block">
                        <h2 class="activity-section-heading">About This Activity</h2>
                        <p class="activity-section-text">{{ $activity->description }}</p>
                    </div>

                    {{-- What You'll Learn --}}
                    <div class="activity-content-block">
                        <h2 class="activity-section-heading">What You'll Learn</h2>
                        <ul class="activity-learning-list">
                            <li>Practical skills and knowledge relevant to {{ strtolower($activity->name) }}</li>
                            <li>Industry best practices and expert insights</li>
                            <li>Networking opportunities with like-minded professionals</li>
                            <li>Actionable strategies you can implement immediately</li>
                        </ul>
                    </div>

                    {{-- Who Should Attend --}}
                    <div class="activity-content-block">
                        <h2 class="activity-section-heading">Who Should Attend</h2>
                        <p class="activity-section-text">This activity is perfect for entrepreneurs, small business owners, and professionals looking to enhance their skills in {{ strtolower($activity->name) }}. Whether you're just starting out or looking to refine your existing knowledge, this session will provide valuable insights and practical takeaways.</p>
                    </div>
                </div>

                {{-- Right Column: Activity Details Sidebar --}}
            <div class="col-lg-4">
                <div class="activity-details-sidebar">
                    <h3 class="activity-details-heading">Activity Details</h3>

                    <div class="activity-details-list">
                        <div class="activity-detail-item">
                            <i class="material-icons-round">event</i>
                            <div>
                                <div class="activity-detail-label">Date</div>
                                <div class="activity-detail-value">{{ $activity->date->format('l, d F Y') }}</div>
                            </div>
                        </div>

                        @if($activity->duration)
                        <div class="activity-detail-item">
                            <i class="material-icons-round">schedule</i>
                            <div>
                                <div class="activity-detail-label">Time</div>
                                <div class="activity-detail-value">{{ $activity->duration }}</div>
                            </div>
                        </div>
                        @endif

                        @if($activity->location)
                        <div class="activity-detail-item">
                            <i class="material-icons-round">location_on</i>
                            <div>
                                <div class="activity-detail-label">Location</div>
                                <div class="activity-detail-value">{{ $activity->location }}</div>
                            </div>
                        </div>
                        @endif

                        <div class="activity-detail-item">
                            <i class="material-icons-round">currency_pound</i>
                            <div>
                                <div class="activity-detail-label">Price</div>
                                <div class="activity-detail-value">{{ $activity->price && strtolower($activity->price) !== 'free' ? $activity->price : 'Free' }}</div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-register-now" data-bs-toggle="modal" data-bs-target="#registrationModal">
                        Register Now
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>

    {{-- Related Activities --}}
    @if($relatedActivities->count() > 0)
    <div class="related-activities-section">
        <div class="activities-page-container">
            <div class="related-activities-header">
                <h3 class="related-activities-title">Related Activities</h3>
            </div>

            <div class="activities-grid">
            @foreach($relatedActivities as $relatedActivity)
            <article class="related-activity-card">
                <a href="{{ route('activities.show', $relatedActivity->id) }}" class="activity-card-link">
                    <div class="related-activity-image">
                        <img src="{{ $relatedActivity->image_url }}" alt="{{ $relatedActivity->name }}">
                        <div class="activity-card-image-overlay"></div>
                    </div>
                    <div class="related-activity-body">
                        <div class="related-activity-meta">
                            <span class="related-company-badge">{{ $relatedActivity->company }}</span>
                            <time class="related-activity-date">{{ $relatedActivity->date->format('d M') }}</time>
                        </div>
                        <h3 class="related-activity-title">{{ $relatedActivity->name }}</h3>
                    </div>
                </a>
            </article>
            @endforeach
            </div>
        </div>
    </div>
    @endif
</section>

{{-- Registration Modal --}}
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Register for Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('activity.register') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{-- Activity Details (readonly) --}}
                    <div class="mb-3">
                        <label class="form-label">Activity</label>
                        <input type="text" class="form-control" value="{{ $activity->name }}" readonly>
                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                        <input type="hidden" name="activity_name" value="{{ $activity->name }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date</label>
                            <input type="text" class="form-control" value="{{ $activity->date->format('d M Y') }}" readonly>
                            <input type="hidden" name="activity_date" value="{{ $activity->date->format('Y-m-d') }}">
                        </div>
                        @if($activity->duration)
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Time</label>
                            <input type="text" class="form-control" value="{{ $activity->duration }}" readonly>
                            <input type="hidden" name="activity_time" value="{{ $activity->duration }}">
                        </div>
                        @endif
                    </div>

                    @if($activity->location)
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" value="{{ $activity->location }}" readonly>
                        <input type="hidden" name="activity_location" value="{{ $activity->location }}">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" value="{{ $activity->price && strtolower($activity->price) !== 'free' ? $activity->price : 'Free' }}" readonly>
                        <input type="hidden" name="activity_price" value="{{ $activity->price ?? 'Free' }}">
                    </div>

                    <hr class="my-4">

                    {{-- User Details (input) --}}
                    <div class="mb-3">
                        <label for="userName" class="form-label">Your Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Your Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Registration</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
