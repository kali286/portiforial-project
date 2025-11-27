@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project: ' . $project->title)

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title *</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title', $project->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description *</label>
                        <textarea class="form-control" id="short_description" name="short_description" 
                                  rows="3" required>{{ old('short_description', $project->short_description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description *</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="6" required>{{ old('description', $project->description) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ $project->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if($project->image)
                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div>
                            <img src="{{ $project->image }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">New Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="project_url" class="form-label">Project URL</label>
                        <input type="url" class="form-control" id="project_url" name="project_url" 
                               value="{{ old('project_url', $project->project_url) }}">
                    </div>

                    <div class="mb-3">
                        <label for="github_url" class="form-label">GitHub URL</label>
                        <input type="url" class="form-control" id="github_url" name="github_url" 
                               value="{{ old('github_url', $project->github_url) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                {{ $project->featured ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Featured Project
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                {{ $project->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">
                                Active Project
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Project</button>
            </div>
        </form>
    </div>
</div>
@endsection