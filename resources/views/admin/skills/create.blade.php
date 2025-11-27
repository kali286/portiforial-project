@extends('layouts.admin')

@section('title', 'Add Skill')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.skills.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Level (1-100) *</label>
            <input type="number" name="level" class="form-control" min="1" max="100" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon</label>
            <input type="text" name="icon" class="form-control" placeholder="e.g. fa-brands fa-laravel">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="color" name="color" class="form-control form-control-color" value="#0d6efd">
          </div>
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0">
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection
