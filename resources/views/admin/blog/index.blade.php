@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('actions')
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> New Blog Post
    </a>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">All Blog Posts</h6>
        <div class="d-flex">
            <input type="text" class="form-control form-control-sm me-2" placeholder="Search posts..." style="width: 200px;">
            <select class="form-select form-select-sm" style="width: 150px;">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" 
                                         class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $blog->title }}</div>
                                    <small class="text-muted">{{ $blog->slug }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-{{ $blog->is_published ? 'success' : 'warning' }}">
                                {{ $blog->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>{{ $blog->view_count }}</td>
                        <td>
                            @if($blog->published_at)
                                {{ $blog->published_at->format('M d, Y') }}
                            @else
                                <span class="text-muted">Not published</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.blog.show', $blog->id) }}" class="btn btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-blog fa-3x mb-3"></i>
                            <p>No blog posts found.</p>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Create your first blog post</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($blogs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection