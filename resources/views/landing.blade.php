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
<section id="partners" class="section bg-light">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <p class="text-primary-pink fw-semibold mb-2">Our Partners</p>
                <h2 class="display-5 fw-bold text-dark mb-3">Working Together for Success</h2>
                <p class="fs-5 text-muted mb-4">Uniting Vision, Igniting Growth</p>
                <p class="text-muted mb-5">
                    BASE collaborates with a network of enterprise organisations, universities, and business support services to provide mentorship, industry insights, and hands-on learning opportunities. Our key partners include:
                </p>
            </div>
        </div>

        <div class="partners-carousel-wrapper position-relative mt-5 mb-5">
            <div class="partners-carousel-overlay partners-carousel-overlay-left"></div>
            <div class="partners-carousel">
                <div class="partners-carousel-track">
                    <div class="partner-logo-item">
                        <a href="https://www.elevatoruk.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/elevator-uk.svg') }}" alt="Elevator UK" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.brightredtriangle.co.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/brt_logo.png') }}" alt="BRT" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/edinburgh/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-edinburgh.png') }}" alt="Business Gateway Edinburgh" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/midlothian/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-midlothian.png') }}" alt="Business Gateway Midlothian" class="partner-logo partner-logo-large">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.mcoe.org.uk/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/mc_coa.png') }}" alt="The Royal Company of Merchants of Edinburgh" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.qmu.ac.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/qmu.png') }}" alt="Queen Margaret University" class="partner-logo partner-logo-medium">
                        </a>
                    </div>
                    <!-- Duplicate for seamless loop -->
                    <div class="partner-logo-item">
                        <a href="https://www.elevatoruk.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/elevator-uk.svg') }}" alt="Elevator UK" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.brightredtriangle.co.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/brt_logo.png') }}" alt="BRT" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/edinburgh/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-edinburgh.png') }}" alt="Business Gateway Edinburgh" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.bgateway.com/local-offices/midlothian/local-support" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/bg-midlothian.png') }}" alt="Business Gateway Midlothian" class="partner-logo partner-logo-large">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.mcoe.org.uk/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/mc_coa.png') }}" alt="The Royal Company of Merchants of Edinburgh" class="partner-logo">
                        </a>
                    </div>
                    <div class="partner-logo-item">
                        <a href="https://www.qmu.ac.uk" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/partners/qmu.png') }}" alt="Queen Margaret University" class="partner-logo partner-logo-medium">
                        </a>
                    </div>
                </div>
            </div>
            <div class="partners-carousel-overlay partners-carousel-overlay-right"></div>
        </div>

        <div class="row justify-content-center text-center mt-5">
            <div class="col-lg-8">
                <p class="text-muted">
                    These partnerships ensure that BASE participants gain access to the best resources and support available for developing their business ideas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Activities Section -->
<section id="activities" class="section position-relative activities-section">
    <div class="activities-gradient-blur"></div>
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 mb-5">
                <p class="text-primary-pink fw-semibold mb-2">Accelerate Your Growth</p>
                <h2 class="display-5 fw-bold text-dark mb-3">Activities That Drive Success</h2>
                <p class="fs-6 text-muted">
                    Choose from our range of specialised activities designed to support businesses at every stage of their journey.
                </p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($activities ?? [] as $activity)
            <div class="col-lg-4 col-md-6">
                <article class="activity-card">
                    <div class="activity-card-image">
                        <img src="{{ $activity->image_url }}" alt="{{ $activity->name }}" class="w-100">
                        <div class="activity-card-image-overlay"></div>
                    </div>
                    <div class="activity-card-body">
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <span class="badge bg-primary-pink text-white px-3 py-2">{{ $activity->company }}</span>
                            <time class="small text-muted">{{ $activity->date->format('M d, Y') }}</time>
                        </div>
                        <h3 class="activity-card-title h5 fw-bold mb-3">{{ $activity->name }}</h3>
                        <p class="activity-card-description text-muted">{{ Str::limit($activity->description, 100) }}</p>
                    </div>
                    <div class="activity-card-footer">
                        <div class="d-flex align-items-center gap-3">
                            <div class="activity-icon-wrapper">
                                <i class="material-icons-round">{{ strtolower($activity->icon) }}</i>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0 small">{{ $activity->company }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No upcoming activities at this time. Check back soon!</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="/activities" class="btn btn-primary btn-lg rounded-pill px-5">
                View All Activities
            </a>
        </div>
    </div>
</section>

<!-- Support Section -->
<section id="support" class="section bg-light">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 mb-5">
                <p class="text-primary-pink fw-semibold mb-2">Business Support</p>
                <h2 class="display-5 fw-bold text-dark mb-3">Comprehensive Support for Your Business</h2>
                <p class="fs-6 text-muted">
                    Access expert guidance and resources across key business areas to help your company thrive and grow.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Financial Guidance -->
            <div class="col-lg-4 col-md-6">
                <article class="activity-card">
                    <div class="activity-card-image">
                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1920&auto=format&fit=crop" alt="Financial Guidance" class="w-100">
                        <div class="activity-card-image-overlay"></div>
                    </div>
                    <div class="activity-card-body">
                        <h3 class="activity-card-title h5 fw-bold mb-3 text-white">Financial Guidance</h3>
                        <p class="activity-card-description text-white-50">Expert advice on funding, investments, and financial planning for your business.</p>
                    </div>
                </article>
            </div>

            <!-- Marketing Strategy -->
            <div class="col-lg-4 col-md-6">
                <article class="activity-card">
                    <div class="activity-card-image">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1920&auto=format&fit=crop" alt="Marketing Strategy" class="w-100">
                        <div class="activity-card-image-overlay"></div>
                    </div>
                    <div class="activity-card-body">
                        <h3 class="activity-card-title h5 fw-bold mb-3 text-white">Marketing Strategy</h3>
                        <p class="activity-card-description text-white-50">Develop effective marketing plans and digital presence to reach your target audience.</p>
                    </div>
                </article>
            </div>

            <!-- Innovation Vouchers -->
            <div class="col-lg-4 col-md-6">
                <article class="activity-card">
                    <div class="activity-card-image">
                        <img src="https://images.unsplash.com/photo-1504384764586-bb4cdc1707b0?q=80&w=1920&auto=format&fit=crop" alt="Innovation Vouchers" class="w-100">
                        <div class="activity-card-image-overlay"></div>
                    </div>
                    <div class="activity-card-body">
                        <h3 class="activity-card-title h5 fw-bold mb-3 text-white">Innovation Vouchers</h3>
                        <p class="activity-card-description text-white-50">This funding offers up to £7,500 on innovative projects.</p>
                    </div>
                </article>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="/support" class="btn btn-primary btn-lg rounded-pill px-5">
                Know More
            </a>
        </div>
    </div>
</section>

<!-- News/Highlights Section -->
<section id="news" class="section position-relative bg-white">
    <div class="activities-gradient-blur"></div>
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 mb-5">
                <p class="text-primary-pink fw-semibold mb-2">Latest Updates</p>
                <h2 class="display-5 fw-bold text-dark mb-3">Highlights & Success Stories</h2>
                <p class="fs-6 text-muted">
                    Stay updated with the latest highlights, events, and inspiring success stories from our business community.
                </p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($highlights ?? [] as $highlight)
            <div class="col-lg-4 col-md-6">
                <article class="activity-card">
                    <div class="activity-card-image">
                        <img src="{{ $highlight->image_url }}" alt="{{ $highlight->title }}" class="w-100">
                        <div class="activity-card-image-overlay"></div>
                    </div>
                    <div class="activity-card-body">
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <span class="badge bg-primary-pink text-white px-3 py-2">{{ $highlight->category }}</span>
                            <time class="small text-muted">{{ $highlight->date->format('M d, Y') }}</time>
                        </div>
                        <h3 class="activity-card-title h5 fw-bold mb-3">{{ $highlight->title }}</h3>
                        <p class="activity-card-description text-muted">{{ Str::limit($highlight->description, 100) }}</p>
                    </div>
                    <div class="activity-card-footer">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $highlight->author_avatar }}" alt="{{ $highlight->author_name }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid white;">
                            <div>
                                <p class="fw-semibold mb-0 small">{{ $highlight->author_name }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No highlights available at this time. Check back soon!</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="/highlights" class="btn btn-primary btn-lg rounded-pill px-5">
                View All Highlights
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title gradient-text">Get in Touch</h2>
                <p class="section-subtitle mt-4">
                    Ready to accelerate your business? Contact us today to learn how BASE can support your growth journey.
                </p>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="custom-card p-4">
                    <h4 class="mb-4">Send us a Message</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 w-100">
                            <i class="material-icons-round align-middle me-2">send</i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="custom-card p-4 mb-4">
                    <h4 class="mb-4">Contact Information</h4>
                    <div class="d-flex mb-4">
                        <div class="card-icon me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                            <i class="material-icons-round">location_on</i>
                        </div>
                        <div>
                            <h6 class="mb-1">Our Location</h6>
                            <p class="text-muted mb-0">
                                Bankhead Avenue, Sighthill<br>
                                Edinburgh, EH11 4DE<br>
                                Scotland
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="card-icon me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                            <i class="material-icons-round">email</i>
                        </div>
                        <div>
                            <h6 class="mb-1">Email Us</h6>
                            <p class="text-muted mb-0">info@base-scotland.com</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="card-icon me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                            <i class="material-icons-round">phone</i>
                        </div>
                        <div>
                            <h6 class="mb-1">Call Us</h6>
                            <p class="text-muted mb-0">+44 (0) 131 XXX XXXX</p>
                        </div>
                    </div>
                </div>
                <div class="custom-card p-4">
                    <h5 class="mb-3">Office Hours</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Monday - Friday:</span>
                        <span class="fw-bold">9:00 AM - 5:00 PM</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Saturday:</span>
                        <span class="fw-bold">10:00 AM - 2:00 PM</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Sunday:</span>
                        <span class="fw-bold">Closed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
