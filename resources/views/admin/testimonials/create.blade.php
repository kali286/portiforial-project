@extends('layouts.admin')

@section('title', 'Add Testimonial')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Client Name *</label>
            <input type="text" name="client_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Rating (1-5) *</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Testimonial *</label>
        <textarea name="testimonial" class="form-control" rows="5" required></textarea>
      </div>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection
