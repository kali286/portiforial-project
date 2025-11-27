<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="SmartStack - Professional Full Stack Developer specializing in Laravel, Vue.js, and modern web technologies. Crafting digital experiences with code and creativity.">
    <meta name="keywords" content="web developer, laravel developer, vue.js, full stack developer, portfolio, web design">
    <meta name="author" content="SmartStack">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="SmartStack - Professional Web Developer">
    <meta property="og:description" content="Crafting digital experiences with code and creativity. Full Stack Developer specializing in modern web technologies.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    {{-- <meta property="og:image" content="{{ asset('images/og-image.jpg') }}"> --}}
    
    <title>@yield('title', 'SmartStack - Professional Web Developer')</title>
    
    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> --}}
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8b5cf6;
            --accent-color: #06b6d4;
            --dark-color: #1e293b;
            --darker-color: #0f172a;
            --light-color: #f8fafc;
            --gray-color: #64748b;
            --gradient: linear-gradient(135deg, #6366f1, #8b5cf6, #06b6d4);
            --gradient-hover: linear-gradient(135deg, #4f46e5, #7c3aed, #0891b2);
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-color);
            color: var(--dark-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Selection Color */
        ::selection {
            background: var(--primary-color);
            color: white;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* Glass Morphism Effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }
        
        .glass-dark {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: var(--gradient);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            animation: float 8s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            50% { 
                transform: translateY(-20px) rotate(1deg); 
            }
        }

        /* Particle Background */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float-particle 20s infinite linear;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
        
        /* Typing Animation */
        .typing-container {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        #typing-text {
            border-right: 3px solid var(--accent-color);
            animation: blink 0.7s infinite;
            padding-right: 5px;
        }
        
        @keyframes blink {
            0%, 100% { border-color: var(--accent-color); }
            50% { border-color: transparent; }
        }
        
        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: var(--shadow);
            padding: 0.5rem 0;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            position: relative;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        /* Buttons */
        .btn-gradient {
            background: var(--gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gradient-hover);
            transition: left 0.3s ease;
            z-index: -1;
        }
        
        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-gradient:hover::before {
            left: 0;
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        /* Cards */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            box-shadow: var(--shadow);
        }
        
        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-lg);
        }
        
        /* Progress Bars */
        .progress {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            height: 12px;
        }
        
        .progress-bar {
            background: var(--gradient);
            border-radius: 10px;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Footer */
        .footer {
            background: var(--darker-color);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(99,102,241,0.05)" points="0,1000 1000,500 1000,1000"/></svg>');
            background-size: cover;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }
        
        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--shadow);
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
        
        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loader {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .display-4 {
                font-size: 2rem;
            }
            
            .display-5 {
                font-size: 1.8rem;
            }
            
            .navbar {
                padding: 0.5rem 0;
            }
            
            .nav-link {
                margin: 0.25rem 0;
                text-align: center;
            }
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                min-height: 90vh;
            }
            
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .btn-gradient,
            .btn-outline-primary {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Print Styles */
        @media print {
            .navbar,
            .footer,
            .back-to-top {
                display: none !important;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-code me-2 text-primary"></i>
                <span class="gradient-text">SmartStack</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') && !request()->has('#') ? 'active' : '' }}" 
                           href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*#about') ? 'active' : '' }}" 
                           href="{{ route('home') }}#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('skills.index') ? 'active' : '' }}" 
                           href="{{ route('skills.index') }}">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}" 
                           href="{{ route('projects.index') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.index') ? 'active' : '' }}" 
                           href="{{ route('services.index') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" 
                           href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact.create') ? 'active' : '' }}" 
                           href="{{ route('contact.create') }}">Contact</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('admin.login') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Admin
                        </a>
                    </li>
                
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5 position-relative">
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-code me-2 text-primary"></i>
                        <span class="gradient-text">SmartStack</span>
                    </h5>
                    <p class="text-light mb-4">Crafting digital experiences with code and creativity. Transforming ideas into powerful web solutions that drive results.</p>
                    <div class="social-links">
                        <a href="https://github.com" target="_blank" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://dribbble.com" target="_blank" title="Dribbble">
                            <i class="fab fa-dribbble"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none hover-primary">Home</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#about" class="text-light text-decoration-none hover-primary">About</a></li>
                        <li class="mb-2"><a href="{{ route('projects.index') }}" class="text-light text-decoration-none hover-primary">Projects</a></li>
                        <li class="mb-2"><a href="{{ route('blog.index') }}" class="text-light text-decoration-none hover-primary">Blog</a></li>
                        <li class="mb-2"><a href="{{ route('contact.create') }}" class="text-light text-decoration-none hover-primary">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Services</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('services.index') }}" class="text-light text-decoration-none hover-primary">Web Development</a></li>
                        <li class="mb-2"><a href="{{ route('services.index') }}" class="text-light text-decoration-none hover-primary">Mobile Apps</a></li>
                        <li class="mb-2"><a href="{{ route('services.index') }}" class="text-light text-decoration-none hover-primary">UI/UX Design</a></li>
                        <li class="mb-2"><a href="{{ route('services.index') }}" class="text-light text-decoration-none hover-primary">API Development</a></li>
                        <li class="mb-2"><a href="{{ route('services.index') }}" class="text-light text-decoration-none hover-primary">Consulting</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Get In Touch</h6>
                    <ul class="list-unstyled text-light">
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <a href="mailto:hello@smartstack.com" class="text-light text-decoration-none">hello@smartstack.com</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            <a href="tel:+255123456789" class="text-light text-decoration-none">+255 123 456 789</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <span>Dar es Salaam, Tanzania</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock me-2 text-primary"></i>
                            <span>Mon - Fri: 9:00 - 18:00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light">
                        &copy; 2024 <span class="fw-bold">SmartStack</span>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light text-decoration-none me-3 hover-primary">Privacy Policy</a>
                    <a href="#" class="text-light text-decoration-none hover-primary">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const backToTop = document.getElementById('backToTop');
            
            if (window.scrollY > 100) {
                navbar.classList.add('navbar-scrolled');
                backToTop.classList.add('show');
            } else {
                navbar.classList.remove('navbar-scrolled');
                backToTop.classList.remove('show');
            }
        });

        // Scroll animations
        function checkScroll() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    element.classList.add('visible');
                }
            });
        }

        window.addEventListener('scroll', checkScroll);
        window.addEventListener('load', checkScroll);

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Back to top functionality
        document.getElementById('backToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Typing animation
        const typingText = document.getElementById('typing-text');
        if (typingText) {
            const words = ['Full Stack Developer', 'UI/UX Designer', 'Problem Solver', 'Tech Enthusiast', 'Creative Thinker'];
            let wordIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            let typingSpeed = 100;

            function type() {
                const currentWord = words[wordIndex];
                
                if (isDeleting) {
                    typingText.textContent = currentWord.substring(0, charIndex - 1);
                    charIndex--;
                    typingSpeed = 50;
                } else {
                    typingText.textContent = currentWord.substring(0, charIndex + 1);
                    charIndex++;
                    typingSpeed = 100;
                }

                if (!isDeleting && charIndex === currentWord.length) {
                    isDeleting = true;
                    typingSpeed = 1500;
                } else if (isDeleting && charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    typingSpeed = 500;
                }

                setTimeout(type, typingSpeed);
            }

            // Start typing animation when page loads
            setTimeout(type, 1000);
        }

        // Create particle background
        function createParticles() {
            const particlesContainer = document.createElement('div');
            particlesContainer.className = 'particles';
            document.querySelector('.hero-section').appendChild(particlesContainer);

            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 6 + 2;
                const left = Math.random() * 100;
                const animationDuration = Math.random() * 20 + 10;
                const animationDelay = Math.random() * 5;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${left}%`;
                particle.style.animationDuration = `${animationDuration}s`;
                particle.style.animationDelay = `${animationDelay}s`;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles
        createParticles();

        // Add gradient text class
        const style = document.createElement('style');
        style.textContent = `
            .gradient-text {
                background: var(--gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .hover-primary:hover {
                color: var(--primary-color) !important;
            }
        `;
        document.head.appendChild(style);

        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img.lazy').forEach(img => {
                imageObserver.observe(img);
            });
        }
    </script>
    
    @yield('scripts')
</body>
</html>