@extends('layouts.app')

@section('title', $project->title . ' - My Portfolio')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $project->title }}</h1>
            <p class="lead">{{ $project->short_description }}</p>
            
            <div class="mb-4">
                <img src="{{ $project->image ?? 'https://via.placeholder.com/800x400' }}" alt="{{ $project->title }}" class="img-fluid rounded">
            </div>

            <div class="project-details">
                <h3>Project Details</h3>
                <p>{{ $project->description }}</p>
                
                <div class="row mt-4">
                    @if($project->project_url)
                    <div class="col-md-6">
                        <a href="{{ $project->project_url }}" class="btn btn-primary" target="_blank">
                            <i class="fas fa-external-link-alt"></i> View Live Project
                        </a>
                    </div>
                    @endif
                    @if($project->github_url)
                    <div class="col-md-6">
                        <a href="{{ $project->github_url }}" class="btn btn-dark" target="_blank">
                            <i class="fab fa-github"></i> View on GitHub
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Project Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Category:</strong> {{ $project->category->name }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $project->status ? 'bg-success' : 'bg-warning' }}">
                            {{ $project->status ? 'Completed' : 'In Progress' }}
                        </span>
                    </p>
                    @if($project->featured)
                        <p><span class="badge bg-info">Featured Project</span></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection