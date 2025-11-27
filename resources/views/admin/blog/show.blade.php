@extends('layouts.admin')

@section('title', $blog->title)

@section('actions')
    <div class="btn-group">
        <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            @if($blog->featured_image)
            <img src="{{ asset('storage/' . $blog->featured_image) }}" class="card-img-top" alt="{{ $blog->title }}">
            @endif
            <div class="card-body">
                <h1 class="card-title h3">{{ $blog->title }}</h1>
                
                <div class="d-flex align-items-center text-muted mb-3">
                    <div class="me-3">
                        <i class="fas fa-eye me-1"></i> {{ $blog->view_count }} views
                    </div>
                    <div class="me-3">
                        <i class="fas fa-clock me-1"></i> {{ $blog->read_time }} min read
                    </div>
                    @if($blog->published_at)
                    <div>
                        <i class="fas fa-calendar me-1"></i> {{ $blog->published_at->format('M d, Y') }}
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <span class="badge bg-{{ $blog->is_published ? 'success' : 'warning' }}">
                        {{ $blog->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>

                @if($blog->excerpt)
                <div class="alert alert-info">
                    <strong>Excerpt:</strong> {{ $blog->excerpt }}
                </div>
                @endif

                <div class="content">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                @if($blog->tags)
                <div class="mt-4 pt-4 border-top">
                    <h6>Tags:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(explode(',', $blog->tags) as $tag)
                            <span class="badge bg-secondary">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Meta Title:</strong>
                    <p class="text-muted">{{ $blog->meta_title ?: 'Not set' }}</p>
                </div>
                <div class="mb-3">
                    <strong>Meta Description:</strong>
                    <p class="text-muted">{{ $blog->meta_description ?: 'Not set' }}</p>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit Post
                    </a>
                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" 
                                onclick="return confirm('Are you sure you want to delete this post?')">
                            <i class="fas fa-trash me-1"></i> Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Views
                        <span class="badge bg-primary rounded-pill">{{ $blog->view_count }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Read Time
                        <span class="badge bg-info rounded-pill">{{ $blog->read_time }} min</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Created
                        <small class="text-muted">{{ $blog->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        Last Updated
                        <small class="text-muted">{{ $blog->updated_at->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection