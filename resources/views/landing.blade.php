@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="home" class="hero-section-reference">
    <div class="hero-content-reference">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="hero-title-reference fade-in-up">
                        <div class="hero-title-line">Base-jump</div>
                        <div class="hero-title-line">Into</div>
                        <div class="hero-title-line">Entrepreneurship</div>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about-section">
    <div class="about-container">
        {{-- First Section: Intro --}}
        <div class="about-intro">
            <h2 class="about-label">About</h2>
            <p class="about-title">What is BASE?</p>
            <p class="about-description">
                BASE (<strong>B</strong>usiness <strong>A</strong>dvice and <strong>S</strong>upport for <strong>E</strong>ntrepreneurs) is Edinburgh College's initiative designed to help students, staff, and local businesses develop key enterprise skills. Whether you're starting a business, refining an idea, or looking to enhance your professional skill set, BASE offers expert-led workshops, practical guidance, and networking opportunities to support your entrepreneurial journey.
            </p>
        </div>

        {{-- Grid Section: Content + Testimonial --}}
        <div class="about-grid">
            {{-- Testimonial (right on lg) --}}
            <div class="about-testimonial-wrapper">
                <figure class="about-testimonial-figure">
                    <blockquote class="about-testimonial-quote">
                        <p>"BASE has been instrumental in our growth journey. Their support and guidance helped us transform our startup into a thriving business."</p>
                    </blockquote>
                    <figcaption class="about-testimonial-author">
                        <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?q=80&w=1920&auto=format&fit=crop"
                             alt="Sarah MacKenzie"
                             class="about-testimonial-avatar">
                        <div class="about-testimonial-info">
                            <div class="about-testimonial-name">Sarah MacKenzie</div>
                            <div class="about-testimonial-title">Founder, Highland Tech Solutions</div>
                        </div>
                    </figcaption>
                </figure>
            </div>

            {{-- Content (left on lg) --}}
            <div class="about-content">
                <p class="about-content-text">
                    Since launching, we've been actively building our presence within Scotland's entrepreneurial ecosystem, offering practical support to businesses at various stages. Our approach blends hands-on experience with forward-thinking ideas to help Scottish businesses develop and grow.
                </p>

                <ul class="about-list">
                    <li class="about-list-item">
                        <span class="about-bullet"></span>
                        <span>
                            <strong class="about-list-strong">Expert Network.</strong> Access to experienced mentors, industry professionals, and support across a range of sectors.
                        </span>
                    </li>
                    <li class="about-list-item">
                        <span class="about-bullet"></span>
                        <span>
                            <strong class="about-list-strong">Building Momentum.</strong> We've already begun supporting a growing number of businesses and individuals on their journey.
                        </span>
                    </li>
                    <li class="about-list-item">
                        <span class="about-bullet"></span>
                        <span>
                            <strong class="about-list-strong">Innovation Focus.</strong> Programmes and resources designed to support the evolving needs of modern business.
                        </span>
                    </li>
                    <li class="about-list-item">
                        <span class="about-bullet"></span>
                        <span>
                            <strong class="about-list-strong">BASE Hubs.</strong> We have dedicated BASE hubs at each Edinburgh College campus. These spaces are used to host workshops, provide one-to-one business support, and connect students and local businesses with opportunities around enterprise and innovation.
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section id="partners" class="partners-section">
    <div class="partners-container">
        {{-- Text content --}}
        <div class="partners-text-container">
            <h2 class="partners-label">Our Partners</h2>
            <p class="partners-title">Working Together for Success</p>
            <p class="partners-subtitle">Uniting Vision, Igniting Growth</p>
            <p class="partners-description">
                BASE collaborates with a network of enterprise organisations, universities, and business support services to provide mentorship, industry insights, and hands-on learning opportunities. Our key partners include:
            </p>
        </div>

        {{-- Logo Carousel --}}
        <div class="partners-carousel-wrapper">
            <div class="partners-carousel-overlay partners-carousel-overlay-left"></div>
            <div class="partners-carousel">
                <div class="partners-carousel-track">
                    <div class="partner-logo-item">
                        <a href="https://www.elevatoruk.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/elevator-uk.svg') }}" alt="Elevator UK" class="partner-logo partner-logo-elevator">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.brightredtriangle.co.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/brt_logo.png') }}" alt="BRT" class="partner-logo partner-logo-brt">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/edinburgh/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-edinburgh.png') }}" alt="Business Gateway Edinburgh" class="partner-logo partner-logo-bg-edinburgh">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/midlothian/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-midlothian.png') }}" alt="Business Gateway Midlothian" class="partner-logo partner-logo-large">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.mcoe.org.uk/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/mc_coa.png') }}" alt="The Royal Company of Merchants of Edinburgh" class="partner-logo partner-logo-mcoe">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.qmu.ac.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/qmu.png') }}" alt="Queen Margaret University" class="partner-logo partner-logo-qmu">
                        </a>
                    </div>
                    <!-- Duplicate for seamless loop -->
                    <div class="partner-logo-item">
                        <a href="https://www.elevatoruk.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/elevator-uk.svg') }}" alt="Elevator UK" class="partner-logo partner-logo-elevator">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.brightredtriangle.co.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/brt_logo.png') }}" alt="BRT" class="partner-logo partner-logo-brt">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/edinburgh/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-edinburgh.png') }}" alt="Business Gateway Edinburgh" class="partner-logo partner-logo-bg-edinburgh">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/midlothian/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-midlothian.png') }}" alt="Business Gateway Midlothian" class="partner-logo partner-logo-large">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.mcoe.org.uk/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/mc_coa.png') }}" alt="The Royal Company of Merchants of Edinburgh" class="partner-logo partner-logo-mcoe">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.qmu.ac.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/qmu.png') }}" alt="Queen Margaret University" class="partner-logo partner-logo-qmu">
                        </a>
                    </div>
                </div>
            </div>
            <div class="partners-carousel-overlay partners-carousel-overlay-right"></div>
        </div>

        {{-- Bottom text --}}
        <div class="partners-bottom-text">
            <p class="partners-bottom-paragraph">
                These partnerships ensure that BASE participants gain access to the best resources and support available for developing their business ideas.
            </p>
        </div>
    </div>
</section>

<!-- Activities Section -->
<section id="activities" class="activities-section">
    <div class="activities-container">
        <div class="activities-text-container">
            <h2 class="activities-label">Accelerate Your Growth</h2>
            <p class="activities-title">Activities That Drive Success</p>
            <p class="activities-description">
                Choose from our range of specialised activities designed to support<br class="activities-line-break"> businesses at every stage of their journey.
            </p>
        </div>

        <div class="activities-grid">
            @forelse($activities ?? [] as $activity)
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
                <p>No upcoming activities at this time. Check back soon!</p>
            </div>
            @endforelse
        </div>

        <div class="activities-button-container">
            <a href="/activities" class="activities-button">
                View All Activities
            </a>
        </div>
    </div>
</section>

<!-- Support Section -->
<section id="support" class="support-section">
    <div class="support-container">
        <div class="support-text-container">
            <h2 class="support-label">Business Support</h2>
            <p class="support-title">Comprehensive Support for Your Business</p>
            <p class="support-description">
                Access expert guidance and resources across key business areas to help<br class="support-line-break"> your company thrive and grow.
            </p>
        </div>

        <div class="support-grid">
            <!-- Financial Guidance -->
            <article class="support-card">
                <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1920&auto=format&fit=crop" alt="Financial Guidance" class="support-card-image">
                <div class="support-card-gradient"></div>
                <div class="support-card-ring"></div>
                <h3 class="support-card-title">Financial Guidance</h3>
                <p class="support-card-description">Expert advice on funding, investments, and financial planning for your business.</p>
            </article>

            <!-- Marketing Strategy -->
            <article class="support-card">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1920&auto=format&fit=crop" alt="Marketing Strategy" class="support-card-image">
                <div class="support-card-gradient"></div>
                <div class="support-card-ring"></div>
                <h3 class="support-card-title">Marketing Strategy</h3>
                <p class="support-card-description">Develop effective marketing plans and digital presence to reach your target audience.</p>
            </article>

            <!-- Innovation Vouchers -->
            <article class="support-card">
                <img src="https://images.unsplash.com/photo-1504384764586-bb4cdc1707b0?q=80&w=1920&auto=format&fit=crop" alt="Innovation Vouchers" class="support-card-image">
                <div class="support-card-gradient"></div>
                <div class="support-card-ring"></div>
                <h3 class="support-card-title">Innovation Vouchers</h3>
                <p class="support-card-description">This funding offers up to £7,500 on innovative projects.</p>
            </article>
        </div>

        <div class="support-button-container">
            <a href="/support" class="support-button">
                Know More
            </a>
        </div>
    </div>
</section>

<!-- News/Highlights Section -->
<section id="news" class="highlights-section">
    <div class="highlights-container">
        <div class="highlights-text-container">
            <h2 class="highlights-label">Latest Updates</h2>
            <p class="highlights-title">Highlights & Success Stories</p>
            <p class="highlights-description">
                Stay updated with the latest highlights, events, and inspiring success<br class="highlights-line-break"> stories from our business community.
            </p>
        </div>

        <div class="highlights-grid">
            @forelse($highlights ?? [] as $highlight)
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
                <p>No highlights available at this time. Check back soon!</p>
            </div>
            @endforelse
        </div>

        <div class="highlights-button-container">
            <a href="/highlights" class="highlights-button">
                View All Highlights
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="contact-grid">
        <!-- Left side - Text content with full-height background -->
        <div class="contact-left">
            <!-- Full-height gray background -->
            <div class="contact-left-background"></div>

            <div class="contact-left-inner">
                <h2 class="contact-label">Get in Touch & Connect</h2>
                <p class="contact-title">Contact Us</p>
                <p class="contact-description">
                    Reach out to us for enquiries, support, or collaboration opportunities. We're here to help and look forward to hearing from you.
                </p>
                <p class="contact-description-2">
                    Use the form or email us to start the conversation.
                </p>
            </div>
        </div>

        <!-- Right side - Form -->
        <form action="{{ route('contact.submit') }}" method="POST" class="contact-right">
            @csrf

            {{-- Success Message --}}
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    <strong>✓ Success!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="contact-form-inner">
                <div class="contact-form-grid">
                    <div class="contact-form-field">
                        <label for="name" class="contact-label-text">Name</label>
                        <div class="contact-input-wrapper">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="name" class="contact-input" required>
                        </div>
                        @error('name')
                            <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-form-field">
                        <label for="email" class="contact-label-text">Email</label>
                        <div class="contact-input-wrapper">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email" class="contact-input" required>
                        </div>
                        @error('email')
                            <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Honeypot field - Hidden from users, visible to bots --}}
                    <div class="contact-form-field" style="position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden;" aria-hidden="true" tabindex="-1">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" value="{{ old('website') }}" autocomplete="off" tabindex="-1">
                    </div>

                    <div class="contact-form-field">
                        <label for="message" class="contact-label-text">Message</label>
                        <div class="contact-input-wrapper">
                            <textarea name="message" id="message" rows="4" class="contact-input" required>{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <span style="color: #dc3545; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="contact-button-wrapper">
                    <button type="submit" class="contact-button">
                        Send Message
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
