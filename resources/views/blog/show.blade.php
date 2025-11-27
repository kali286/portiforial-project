@extends('layouts.app')

@section('title', $blog->title . ' - My Portfolio')

@section('content')
<div class="container py-5">
    <article class="blog-post">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <header class="mb-4">
                    <h1 class="fw-bold">{{ $blog->title }}</h1>
                    <div class="d-flex align-items-center text-muted mb-3">
                        <span class="me-3">
                            <i class="fas fa-calendar"></i> 
                            {{ $blog->published_at->format('F d, Y') }}
                        </span>
                        <span class="badge bg-primary">{{ $blog->category->name }}</span>
                    </div>
                </header>

                @if($blog->featured_image)
                <div class="mb-4">
                    <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                </div>
                @endif

                <div class="blog-content">
                    {!! $blog->content !!}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Blog
                    </a>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection