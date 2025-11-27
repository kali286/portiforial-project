@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('actions')
    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Blog Post</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug *</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="12" required>{{ old('content', $blog->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Publication</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_published" 
                                           id="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        Published
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="published_at" class="form-label">Publish Date</label>
                                <input type="datetime-local" class="form-control" 
                                       id="published_at" name="published_at" 
                                       value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Featured Image</h6>
                        </div>
                        <div class="card-body">
                            @if($blog->featured_image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                         alt="Current featured image" class="img-fluid rounded mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_featured_image" id="remove_featured_image" value="1">
                                        <label class="form-check-label" for="remove_featured_image">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                       value="{{ old('meta_title', $blog->meta_title) }}">
                            </div>

                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" 
                                          rows="3">{{ old('meta_description', $blog->meta_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Additional Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tags" class="form-label">Tags</label>
                                        <input type="text" class="form-control" id="tags" name="tags" 
                                               value="{{ old('tags', $blog->tags) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="read_time" class="form-label">Read Time (minutes)</label>
                                        <input type="number" class="form-control" id="read_time" name="read_time" 
                                               value="{{ old('read_time', $blog->read_time) }}" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Blog Post</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection