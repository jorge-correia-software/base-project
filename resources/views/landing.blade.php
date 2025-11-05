@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="hero-gradient-overlay"></div>
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="fade-in-up">
                    <h1 class="hero-title">
                        Empowering <span class="gradient-text">Business Growth</span> in Scotland
                    </h1>
                    <p class="hero-subtitle">
                        BASE provides comprehensive support, funding opportunities, and expert guidance to help Scottish businesses thrive and succeed.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#programs" class="btn btn-primary btn-lg rounded-pill px-5">
                            Explore Programs
                            <i class="material-icons-round align-middle ms-2">arrow_forward</i>
                        </a>
                        <a href="#contact" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                            Get in Touch
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center fade-in-up">
                    <img src="{{ asset('img/hero-illustration.svg') }}" alt="Business Growth" class="img-fluid" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section bg-light-pink">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title gradient-text">About BASE</h2>
                <p class="section-subtitle mt-4">
                    Business Acceleration and Support Enterprise (BASE) is Scotland's premier business support organization, dedicated to fostering innovation, growth, and sustainability across all sectors.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">target</i>
                    </div>
                    <h3 class="card-title">Our Mission</h3>
                    <p class="card-text">
                        To empower Scottish businesses with the tools, resources, and support needed to achieve sustainable growth and competitive advantage.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">visibility</i>
                    </div>
                    <h3 class="card-title">Our Vision</h3>
                    <p class="card-text">
                        To be the leading catalyst for business innovation and excellence throughout Scotland, driving economic prosperity for all.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mx-auto">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">favorite</i>
                    </div>
                    <h3 class="card-title">Our Values</h3>
                    <p class="card-text">
                        Integrity, innovation, collaboration, and excellence guide everything we do as we support Scotland's business community.
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row mt-5 pt-5">
            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="stat-number">500+</div>
                <div class="stat-label">Businesses Supported</div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="stat-number">£10M+</div>
                <div class="stat-label">Funding Distributed</div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="stat-number">1,200+</div>
                <div class="stat-label">Jobs Created</div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 text-center">
                <div class="stat-number">15+</div>
                <div class="stat-label">Years Experience</div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="programs" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title gradient-text">Our Programs</h2>
                <p class="section-subtitle mt-4">
                    Tailored programs designed to accelerate your business growth at every stage of your journey.
                </p>
            </div>
        </div>
        <div class="row g-4" id="programsContainer">
            @forelse($programs ?? [] as $program)
            <div class="col-lg-4 col-md-6">
                <div class="custom-card program-card p-4">
                    <div class="card-icon">
                        <i class="material-icons-round">{{ $program->icon ?? 'rocket_launch' }}</i>
                    </div>
                    <h3 class="card-title">{{ $program->title }}</h3>
                    <p class="card-text">{{ $program->description }}</p>
                    @if($program->link_url)
                        <a href="{{ $program->link_url }}" class="btn btn-sm btn-outline-primary rounded-pill mt-3">
                            {{ $program->link_text }}
                            <i class="material-icons-round align-middle ms-1" style="font-size: 16px;">arrow_forward</i>
                        </a>
                    @endif
                </div>
            </div>
            @empty
            <!-- Default Programs -->
            <div class="col-lg-4 col-md-6">
                <div class="custom-card program-card p-4">
                    <div class="card-icon">
                        <i class="material-icons-round">rocket_launch</i>
                    </div>
                    <h3 class="card-title">Startup Accelerator</h3>
                    <p class="card-text">
                        Intensive support for early-stage businesses with mentorship, funding access, and growth resources.
                    </p>
                    <a href="#contact" class="btn btn-sm btn-outline-primary rounded-pill mt-3">
                        Learn More
                        <i class="material-icons-round align-middle ms-1" style="font-size: 16px;">arrow_forward</i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="custom-card program-card p-4">
                    <div class="card-icon">
                        <i class="material-icons-round">trending_up</i>
                    </div>
                    <h3 class="card-title">Growth Programme</h3>
                    <p class="card-text">
                        Strategic support for established businesses looking to scale operations and expand market reach.
                    </p>
                    <a href="#contact" class="btn btn-sm btn-outline-primary rounded-pill mt-3">
                        Learn More
                        <i class="material-icons-round align-middle ms-1" style="font-size: 16px;">arrow_forward</i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="custom-card program-card p-4">
                    <div class="card-icon">
                        <i class="material-icons-round">eco</i>
                    </div>
                    <h3 class="card-title">Sustainability Initiative</h3>
                    <p class="card-text">
                        Helping businesses transition to sustainable practices with expert guidance and green funding opportunities.
                    </p>
                    <a href="#contact" class="btn btn-sm btn-outline-primary rounded-pill mt-3">
                        Learn More
                        <i class="material-icons-round align-middle ms-1" style="font-size: 16px;">arrow_forward</i>
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Support Section -->
<section id="support" class="section bg-light-pink">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title gradient-text">Support Areas</h2>
                <p class="section-subtitle mt-4">
                    Comprehensive support across all aspects of your business operations and development.
                </p>
            </div>
        </div>
        <div class="row g-4">
            @forelse($supportAreas ?? [] as $area)
            <div class="col-lg-3 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">{{ $area->icon ?? 'support' }}</i>
                    </div>
                    <h4 class="card-title h5">{{ $area->title }}</h4>
                    <p class="card-text small">{{ $area->description }}</p>
                </div>
            </div>
            @empty
            <!-- Default Support Areas -->
            <div class="col-lg-3 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">account_balance</i>
                    </div>
                    <h4 class="card-title h5">Funding & Grants</h4>
                    <p class="card-text small">Access to various funding opportunities and grant applications</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">school</i>
                    </div>
                    <h4 class="card-title h5">Training & Development</h4>
                    <p class="card-text small">Professional development and skills training programs</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">groups</i>
                    </div>
                    <h4 class="card-title h5">Mentorship</h4>
                    <p class="card-text small">One-on-one guidance from experienced business leaders</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="custom-card text-center p-4">
                    <div class="card-icon mx-auto">
                        <i class="material-icons-round">network_check</i>
                    </div>
                    <h4 class="card-title h5">Networking</h4>
                    <p class="card-text small">Connect with partners, investors, and fellow entrepreneurs</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title gradient-text">Success Stories</h2>
                <p class="section-subtitle mt-4">
                    Hear from businesses that have grown with BASE support.
                </p>
            </div>
        </div>
        <div class="row g-4">
            @forelse($testimonials ?? [] as $testimonial)
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-text">{{ $testimonial->content }}</div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            {{ substr($testimonial->author_name, 0, 1) }}
                        </div>
                        <div>
                            <div class="fw-bold">{{ $testimonial->author_name }}</div>
                            <div class="text-muted small">{{ $testimonial->author_title }}</div>
                            @if($testimonial->author_company)
                                <div class="text-muted small">{{ $testimonial->author_company }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Default Testimonials -->
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-text">
                        BASE provided the perfect springboard for our startup. The mentorship and funding support were invaluable in our first year.
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">S</div>
                        <div>
                            <div class="fw-bold">Sarah Mitchell</div>
                            <div class="text-muted small">CEO, TechFlow Solutions</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-text">
                        The Growth Programme helped us expand into new markets we never thought possible. Outstanding support every step of the way.
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">J</div>
                        <div>
                            <div class="fw-bold">James Robertson</div>
                            <div class="text-muted small">Founder, Scottish Craft Co.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-text">
                        Thanks to BASE's sustainability initiative, we've cut costs and reduced our carbon footprint. A true win-win for our business.
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">E</div>
                        <div>
                            <div class="fw-bold">Emma Douglas</div>
                            <div class="text-muted small">Managing Director, EcoManufacturing Ltd</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- News Section -->
<section id="news" class="section bg-light-pink">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title gradient-text">Latest News</h2>
                <p class="section-subtitle mt-4">
                    Stay updated with the latest insights, announcements, and success stories.
                </p>
            </div>
        </div>
        <div class="row g-4">
            @forelse($posts ?? [] as $post)
            <div class="col-lg-4 col-md-6">
                <x-post-card :post="$post" :excerptLimit="100" :showViews="false" />
            </div>
            @empty
            <!-- Default News Items -->
            <div class="col-lg-4 col-md-6">
                <div class="custom-card overflow-hidden">
                    <div class="bg-gradient-primary" style="height: 200px;"></div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary-pink text-white">News</span>
                            <small class="text-muted">{{ now()->format('M d, Y') }}</small>
                        </div>
                        <h4 class="card-title h5">New Funding Opportunities Available</h4>
                        <p class="card-text">BASE announces £2M in new funding for Scottish startups in tech and sustainability sectors...</p>
                        <a href="#contact" class="btn btn-sm btn-outline-primary rounded-pill">
                            Read More
                            <i class="material-icons-round align-middle ms-1" style="font-size: 16px;">arrow_forward</i>
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                View All News
                <i class="material-icons-round align-middle ms-2">arrow_forward</i>
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
