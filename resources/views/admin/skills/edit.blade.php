@extends('layouts.admin')

@section('title', 'Edit Skill')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $skill->name) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Level (1-100) *</label>
            <input type="number" name="level" class="form-control" min="1" max="100" value="{{ old('level', $skill->level) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $skill->icon) }}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', $skill->color ?? '#0d6efd') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $skill->sort_order) }}">
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
