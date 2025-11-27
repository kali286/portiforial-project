@extends('layouts.admin')

@section('title', 'Add New Project')
@section('page-title', 'Add New Project')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description *</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date *</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tech_stack" class="form-label">Tech Stack</label>
                        <textarea class="form-control" id="tech_stack" name="tech_stack" rows="3" placeholder="e.g. Laravel, MySQL, Bootstrap or one per line"></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image *</label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image" required>
                    </div>

                    <div class="mb-3">
                        <label for="project_url" class="form-label">Project URL</label>
                        <input type="url" class="form-control" id="project_url" name="project_url">
                    </div>

                    <div class="mb-3">
                        <label for="github_url" class="form-label">GitHub URL</label>
                        <input type="url" class="form-control" id="github_url" name="github_url">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                            <label class="form-check-label" for="is_featured">Featured Project</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" checked>
                            <label class="form-check-label" for="is_published">Published</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Project</button>
            </div>
        </form>
    </div>
</div>
@endsection