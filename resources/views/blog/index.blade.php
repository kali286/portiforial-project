@extends('layouts.app')

@section('title', 'Blog - My Portfolio')

@section('content')
<div class="container py-5">
  <h1 class="text-center mb-5">My Blog</h1>

  <div class="row">
    <div class="col-lg-8">
      <div class="row">
        @forelse($blogs as $blog)
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <img src="{{ $blog->featured_image ?? 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $blog->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $blog->title }}</h5>
              <p class="card-text">{{ $blog->excerpt }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Published: {{ optional($blog->published_at)->format('M d, Y') }}</small>
                @if(isset($blog->category))
                <span class="badge bg-primary">{{ $blog->category->name }}</span>
                @endif
              </div>
            </div>
            <div class="card-footer">
              <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary btn-sm">Read More</a>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <div class="text-center py-5">
            <h4 class="fw-bold mb-2">Articles are on the way</h4>
            <p class="text-muted mb-4">I’m writing fresh content on engineering, design, and product. Check back soon or follow along for updates.</p>
            <a href="{{ route('contact.create') }}" class="btn btn-gradient"><i class="fas fa-envelope me-2"></i>Request a topic</a>
          </div>
        </div>
        @endforelse
      </div>

      @if(method_exists($blogs, 'hasPages') && $blogs->hasPages())
      <div class="d-flex justify-content-center mt-4">
        {{ $blogs->links() }}
      </div>
      @endif
    </div>

    <div class="col-lg-4">
      @isset($recentBlogs)
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="mb-3">Recent Posts</h5>
          @forelse($recentBlogs as $rb)
            <a class="d-block text-decoration-none mb-2" href="{{ route('blog.show', $rb->id) }}">{{ $rb->title }}</a>
          @empty
            <div class="text-muted">No recent posts.</div>
          @endforelse
        </div>
      </div>
      @endisset

      @isset($categories)
      <div class="card">
        <div class="card-body">
          <h5 class="mb-3">Categories</h5>
          @forelse($categories as $cat)
            <a class="d-block text-decoration-none mb-2" href="{{ route('blog.byCategory', $cat->id) }}">{{ $cat->name }}</a>
          @empty
            <div class="text-muted">No categories.</div>
          @endforelse
        </div>
      </div>
      @endisset
    </div>
  </div>
</div>
@endsection