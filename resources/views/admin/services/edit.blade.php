@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order) }}">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Description *</label>
        <textarea name="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Features (optional)</label>
        <textarea name="features" class="form-control" rows="4">{{ old('features', $service->features) }}</textarea>
      </div>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
