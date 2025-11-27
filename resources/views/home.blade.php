@extends('layouts.app')

@section('title', 'Home - SmartStack Portfolio')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center position-relative" id="home">
    <div class="hero-bg" id="hero-bg"></div>
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass rounded-3 p-5 mb-4">
                    <h1 class="display-4 fw-bold mb-4 text-white">SmartStack</h1>
                    <div class="typing-container mb-4">
                        <h2 class="h1 text-white">I'm a <span id="typing-text" class="text-warning fw-bold"></span></h2>
                    </div>
                    <p class="lead mb-4 text-light">Crafting digital experiences with code and creativity. Transforming ideas into powerful web solutions.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('projects.index') }}" class="btn btn-light btn-lg px-4 py-3 glass btn-gradient">
                            <i class="fas fa-briefcase me-2"></i>View My Work
                        </a>
                        <a href="{{ route('contact.create') }}" class="btn btn-outline-light btn-lg px-4 py-3 glass">
                            <i class="fas fa-paper-plane me-2"></i>Get In Touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4">
        <a href="#about" class="text-white text-decoration-none">
            <div class="d-flex flex-column align-items-center">
                <span class="mb-2">Scroll Down</span>
                <i class="fas fa-chevron-down fa-bounce"></i>
            </div>
        </a>
    </div>
</section>

<!-- About Section -->
<section class="py-5 fade-in" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="badge bg-primary mb-3 p-2">About Me</span>
                <h2 class="display-5 fw-bold mb-4">Crafting Digital Excellence</h2>
                <p class="lead mb-4">I'm a passionate full-stack developer with {{ $stats['yearsExperience'] }}+ years of experience creating amazing web applications that solve real-world problems.</p>
                <p class="mb-4">Specialized in Laravel, Vue.js, and modern web technologies. I love turning complex problems into simple, beautiful designs that provide exceptional user experiences.</p>
                
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Full-Stack Development</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Responsive Design</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>API Development</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Performance Optimization</span>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-3 flex-wrap mb-4">
                    @foreach($skills->take(4) as $skill)
                    <span class="badge bg-primary fs-6 p-3 glass">{{ $skill->name }}</span>
                    @endforeach
                </div>
                
                <a href="{{ route('about') }}" class="btn btn-primary btn-lg px-4">
                    Learn More About Me <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="col-md-6 text-center">
                <div class="position-relative">
                    <div class="glass rounded-3 p-3 d-inline-block">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=500&q=80" 
                             alt="SmartStack Developer" 
                             class="img-fluid rounded-3"
                             style="max-width: 400px; height: 500px; object-fit: cover;">
                    </div>
                    <div class="position-absolute top-0 start-0 mt-3 ms-3">
                        <div class="glass p-3 rounded-circle">
                            <i class="fas fa-code text-primary fa-2x"></i>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 end-0 mb-3 me-3">
                        <div class="glass p-3 rounded-circle">
                            <i class="fas fa-rocket text-success fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="py-5 bg-light fade-in" id="skills">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-secondary mb-3 p-2">My Skills</span>
            <h2 class="display-5 fw-bold mb-3">Technical Expertise</h2>
            <p class="lead text-muted">Here are the technologies and tools I work with</p>
        </div>
        
        <div class="row">
            @foreach($skills as $skill)
            <div class="col-lg-6 mb-4">
                <div class="card p-4 h-100 glass card-hover">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            @if($skill->icon)
                            <i class="{{ $skill->icon }} me-3 fa-2x" style="color: {{ $skill->color ?? '#6366f1' }}"></i>
                            @else
                            <i class="fas fa-code me-3 fa-2x text-primary"></i>
                            @endif
                            <h5 class="mb-0 fw-bold">{{ $skill->name }}</h5>
                        </div>
                        <span class="badge bg-primary fs-6">{{ $skill->level }}%</span>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar" 
                             style="width: 0%; background: linear-gradient(90deg, {{ $skill->color ?? '#6366f1' }}, {{ $skill->color ?? '#6366f1' }}99);"
                             data-width="{{ $skill->level }}"></div>
                    </div>
                    <div class="mt-2 text-end">
                        <small class="text-muted">Proficiency Level</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('skills.index') }}" class="btn btn-outline-primary btn-lg px-5">
                View All Skills <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-5 fade-in" id="projects">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary mb-3 p-2">Portfolio</span>
            <h2 class="display-5 fw-bold mb-3">Featured Projects</h2>
            <p class="lead text-muted">Some of my recent work that I'm proud of</p>
        </div>
        
        @if($featuredProjects->count() > 0)
        <div class="row">
            @foreach($featuredProjects as $project)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 glass card-hover">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ $project->featured_image ? asset('storage/' . $project->featured_image) : 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80' }}" 
                             class="card-img-top" 
                             alt="{{ $project->title }}"
                             style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            @if($project->category)
                            <span class="badge bg-success glass">{{ $project->category->name }}</span>
                            @else
                            <span class="badge bg-success glass">Web</span>
                            @endif
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3">
                            @if($project->is_featured)
                            <span class="badge bg-warning glass">
                                <i class="fas fa-star me-1"></i>Featured
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                        <p class="card-text flex-grow-1 text-muted">
                            {{ Str::limit($project->excerpt ?? $project->description, 120) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="tech-stack">
                                @if($project->tech_stack)
                                    @php
                                        $techs = is_array($project->tech_stack) ? $project->tech_stack : json_decode($project->tech_stack, true) ?? explode(',', $project->tech_stack);
                                    @endphp
                                    @if(is_array($techs))
                                        @foreach(array_slice($techs, 0, 3) as $index => $tech)
                                            <small class="text-muted">{{ is_array($tech) ? $tech['name'] ?? $tech : $tech }}</small>
                                            @if(!$loop->last) • @endif
                                        @endforeach
                                    @else
                                        <small class="text-muted">{{ Str::limit($project->tech_stack, 30) }}</small>
                                    @endif
                                @endif
                            </div>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-project-diagram fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No Featured Projects Yet</h4>
            <p class="text-muted">Check back soon for amazing projects!</p>
        </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-lg px-5">
                View All Projects <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light fade-in" id="services">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-info mb-3 p-2">Services</span>
            <h2 class="display-5 fw-bold mb-3">What I Offer</h2>
            <p class="lead text-muted">Comprehensive web development services tailored to your needs</p>
        </div>
        
        @if($services->count() > 0)
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 glass text-center p-4 card-hover">
                    <div class="mb-4">
                        @if($service->icon)
                        <i class="{{ $service->icon }} fa-3x mb-3" style="color: var(--primary-color);"></i>
                        @else
                        <i class="fas fa-laptop-code fa-3x mb-3 text-primary"></i>
                        @endif
                        <h5 class="fw-bold">{{ $service->title }}</h5>
                    </div>
                    <p class="text-muted mb-4">{{ Str::limit($service->description, 100) }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary btn-sm">
                            Learn More <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-cogs fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No Services Available</h4>
            <p class="text-muted">Services will be added soon!</p>
        </div>
        @endif
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 fade-in" id="testimonials">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-warning mb-3 p-2">Testimonials</span>
            <h2 class="display-5 fw-bold mb-3">What Clients Say</h2>
            <p class="lead text-muted">Don't just take my word for it - hear from my satisfied clients</p>
        </div>
        
        @if($featuredTestimonials->count() > 0)
        <div class="row">
            @foreach($featuredTestimonials as $testimonial)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 glass p-4 card-hover">
                    <div class="mb-3 text-warning">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star {{ $i < $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                    </div>
                    <p class="card-text fst-italic mb-4">"{{ $testimonial->testimonial }}"</p>
                    <div class="d-flex align-items-center mt-auto">
                        @if($testimonial->avatar)
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" 
                             alt="{{ $testimonial->client_name }}" 
                             class="rounded-circle me-3"
                             style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3"
                             style="width: 50px; height: 50px;">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        @endif
                        <div>
                            <h6 class="card-title fw-bold mb-1">{{ $testimonial->client_name }}</h6>
                            <p class="text-muted small mb-0">
                                {{ $testimonial->position ?? 'Client' }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-comments fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No Testimonials Yet</h4>
            <p class="text-muted">Client testimonials will appear here!</p>
        </div>
        @endif
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light fade-in" id="stats">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="glass p-4 rounded-3 card-hover">
                    <i class="fas fa-project-diagram fa-3x text-primary mb-3"></i>
                    <h3 class="display-4 fw-bold text-primary mb-2">{{ $stats['totalProjects'] }}+</h3>
                    <p class="mb-0 fw-semibold">Projects Completed</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="glass p-4 rounded-3 card-hover">
                    <i class="fas fa-smile fa-3x text-success mb-3"></i>
                    <h3 class="display-4 fw-bold text-success mb-2">{{ $stats['happyClients'] }}+</h3>
                    <p class="mb-0 fw-semibold">Happy Clients</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="glass p-4 rounded-3 card-hover">
                    <i class="fas fa-calendar-alt fa-3x text-info mb-3"></i>
                    <h3 class="display-4 fw-bold text-info mb-2">{{ $stats['yearsExperience'] }}+</h3>
                    <p class="mb-0 fw-semibold">Years Experience</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="glass p-4 rounded-3 card-hover">
                    <i class="fas fa-award fa-3x text-warning mb-3"></i>
                    <h3 class="display-4 fw-bold text-warning mb-2">{{ $stats['awards'] }}+</h3>
                    <p class="mb-0 fw-semibold">Awards Won</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 fade-in" style="background: var(--gradient);">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold text-white mb-4">Ready to Start Your Project?</h2>
                <p class="lead text-light mb-4">Let's work together to bring your ideas to life. I'm just a message away!</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('contact.create') }}" class="btn btn-light btn-lg px-4 py-3 glass">
                        <i class="fas fa-paper-plane me-2"></i>Get In Touch
                    </a>
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-light btn-lg px-4 py-3 glass">
                        <i class="fas fa-briefcase me-2"></i>View Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Animate progress bars when they come into view
    function animateProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.getAttribute('data-width');
            if (isElementInViewport(bar) && !bar.classList.contains('animated')) {
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width + '%';
                }, 100);
                bar.classList.add('animated');
            }
        });
    }

    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    window.addEventListener('scroll', animateProgressBars);
    window.addEventListener('load', animateProgressBars);
</script>
@endsection