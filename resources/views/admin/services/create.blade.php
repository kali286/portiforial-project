@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.services.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Icon</label>
            <input type="text" name="icon" class="form-control" placeholder="e.g. fa-solid fa-code">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Description *</label>
        <textarea name="description" class="form-control" rows="5" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Features (optional)</label>
        <textarea name="features" class="form-control" rows="4" placeholder="One feature per line or comma separated"></textarea>
      </div>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection
