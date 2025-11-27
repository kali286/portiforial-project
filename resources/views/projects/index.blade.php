@extends('layouts.app')

@section('title', 'Projects - My Portfolio')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">My Projects</h1>
    
    <div class="row">
        @forelse($projects as $project)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <img src="{{ $project->image ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $project->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <p class="card-text">{{ $project->short_description }}</p>
                    <div class="mb-2">
                        <span class="badge bg-primary">{{ $project->category->name }}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" class="btn btn-outline-primary btn-sm" target="_blank">Live Demo</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <h4 class="fw-bold mb-2">Projects are being curated</h4>
                <p class="text-muted mb-4">I’m currently preparing case studies that best showcase my work. Please check back soon.</p>
                <a href="{{ route('contact.create') }}" class="btn btn-gradient"><i class="fas fa-paper-plane me-2"></i>Start a project</a>
            </div>
        </div>
        @endforelse
    </div>

    @if(method_exists($projects, 'hasPages') && $projects->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $projects->links() }}
    </div>
    @endif
</div>
@endsection