<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 0.75rem 1rem;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #007bff;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .stat-card {
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        <!-- Content Management -->
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3">CONTENT MANAGEMENT</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" 
                               href="{{ route('admin.projects.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-project-diagram me-2"></i>
                                Projects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}" 
                               href="{{ route('admin.blog.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-blog me-2"></i>
                                Blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" 
                               href="{{ route('admin.services.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-cogs me-2"></i>
                                Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}" 
                               href="{{ route('admin.skills.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-tools me-2"></i>
                                Skills
                            </a>
                        </li>
                        
                        <!-- Personal Info -->
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3">PERSONAL INFO</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}" 
                               href="{{ route('admin.experiences.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-briefcase me-2"></i>
                                Experience
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}" 
                               href="{{ route('admin.education.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-graduation-cap me-2"></i>
                                Education
                            </a>
                        </li>
                        
                        <!-- User Content -->
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3">USER CONTENT</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" 
                               href="{{ route('admin.testimonials.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-comments me-2"></i>
                                Testimonials
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" 
                               href="{{ route('admin.messages.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-envelope me-2"></i>
                                Messages
                               
                            @php
                                $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="badge bg-danger float-end">{{ $unreadCount }}</span>
                            @endif
                            </a>
                        </li>
                        
                        <!-- System -->
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3">SYSTEM</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                               href="{{ route('admin.categories.index') }}"> {{-- 🔥 SAHIHISHA HAPA --}}
                                <i class="fas fa-folder me-2"></i>
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" 
                               href="{{ route('admin.settings') }}">
                                <i class="fas fa-cog me-2"></i>
                                Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.backups*') ? 'active' : '' }}" 
                               href="{{ route('admin.backups') }}">
                                <i class="fas fa-database me-2"></i>
                                Backups
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="d-flex">
                            <form class="d-none d-md-flex me-3" action="{{ route('admin.search') }}" method="GET">
                                <input class="form-control me-2" type="search" name="query" placeholder="Search..." aria-label="Search">
                            </form>
                            
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i>
                                    {{ auth()->user()->name ?? 'Admin' }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.profile.index') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('actions')
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
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
    </script>
    
    @yield('scripts')
</body>
</html>