@extends('layouts.admin')

@section('title', 'Dashboard')

@section('actions')
    <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="refreshStats()">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row">
        <!-- Projects -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Projects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalProjects">
                                {{ $stats['totalProjects'] }}
                            </div>
                            <div class="text-xs text-muted">
                                {{ $stats['publishedProjects'] }} Published
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Posts -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Blog Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalBlogs">
                                {{ $stats['totalBlogs'] }}
                            </div>
                            <div class="text-xs text-muted">
                                {{ $stats['publishedBlogs'] }} Published
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-blog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Messages</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalMessages">
                                {{ $stats['totalMessages'] }}
                            </div>
                            <div class="text-xs text-muted">
                                {{ $stats['unreadMessages'] }} Unread
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Testimonials</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalTestimonials">
                                {{ $stats['totalTestimonials'] }}
                            </div>
                            <div class="text-xs text-muted">
                                {{ $stats['pendingTestimonials'] }} Pending
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row">
        <!-- Services -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Services</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalServices'] }}
                            </div>
                            <div class="text-xs text-muted">
                                {{ $stats['activeServices'] }} Active
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-dark shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Skills</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalSkills'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Experience -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Experience</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalExperiences'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Education</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalEducation'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalCategories'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Health -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                System</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Healthy
                            </div>
                            <div class="text-xs text-muted">
                                All Systems OK
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heartbeat fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activities -->
    <div class="row">
        <!-- Recent Projects -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Projects</h6>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentProjects->count() > 0)
                        @foreach($recentProjects as $project)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div class="font-weight-bold text-dark">{{ $project->title }}</div>
                                <div class="small text-gray-500">{{ $project->created_at->format('M d, H:i') }}</div>
                            </div>
                            <div class="small text-gray-600 mt-1">{{ Str::limit($project->description, 80) }}</div>
                            <div class="small text-muted mt-1">
                                <span class="badge bg-{{ $project->is_published ? 'success' : 'warning' }}">
                                    {{ $project->is_published ? 'Published' : 'Draft' }}
                                </span>
                                @if($project->is_featured)
                                <span class="badge bg-info ms-1">Featured</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-project-diagram fa-3x mb-3"></i>
                            <p>No projects yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Messages</h6>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentMessages->count() > 0)
                        @foreach($recentMessages as $message)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="font-weight-bold text-dark">{{ $message->name }}</div>
                                    <div class="small text-gray-600">{{ $message->subject }}</div>
                                </div>
                                <span class="badge bg-{{ $message->status === 'unread' ? 'warning' : 'success' }}">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </div>
                            <div class="small text-muted mt-2">
                                <i class="fas fa-envelope me-1"></i>{{ $message->email }}
                                <i class="fas fa-clock ms-3 me-1"></i>{{ $message->created_at->format('M d, H:i') }}
                            </div>
                            <div class="small text-truncate mt-1">{{ Str::limit($message->message, 100) }}</div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <p>No recent messages</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-2 col-6 mb-3">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary btn-lg w-100 h-100 py-3">
                                <i class="fas fa-plus fa-2x mb-2"></i><br>
                                New Project
                            </a>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-success btn-lg w-100 h-100 py-3">
                                <i class="fas fa-edit fa-2x mb-2"></i><br>
                                Write Blog
                            </a>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-warning btn-lg w-100 h-100 py-3">
                                <i class="fas fa-envelope fa-2x mb-2"></i><br>
                                Check Messages
                            </a>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <a href="{{ route('admin.backups') }}" class="btn btn-outline-info btn-lg w-100 h-100 py-3">
                                <i class="fas fa-database fa-2x mb-2"></i><br>
                                Backup Now
                            </a>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <a href="{{ route('admin.settings') }}" class="btn btn-outline-secondary btn-lg w-100 h-100 py-3">
                                <i class="fas fa-cog fa-2x mb-2"></i><br>
                                Settings
                            </a>
                        </div>
                        <div class="col-md-2 col-6 mb-3">
                            <form action="{{ route('admin.clear-cache') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-lg w-100 h-100 py-3">
                                    <i class="fas fa-broom fa-2x mb-2"></i><br>
                                    Clear Cache
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function refreshStats() {
    fetch('{{ route("admin.stats") }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('totalProjects').textContent = data.totalProjects;
            document.getElementById('totalBlogs').textContent = data.totalBlogs;
            document.getElementById('totalMessages').textContent = data.totalMessages;
            document.getElementById('totalTestimonials').textContent = data.totalTestimonials;
            
            // Show success message
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show';
            alert.innerHTML = `
                Stats updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('main').insertBefore(alert, document.querySelector('main').firstChild);
            
            // Auto remove alert after 3 seconds
            setTimeout(() => {
                alert.remove();
            }, 3000);
        })
        .catch(error => {
            console.error('Error refreshing stats:', error);
        });
}

// Auto-refresh stats every 5 minutes
setInterval(refreshStats, 300000);
</script>
@endsection