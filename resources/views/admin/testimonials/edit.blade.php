@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Client Name *</label>
            <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $testimonial->client_name) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control" value="{{ old('position', $testimonial->position) }}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Rating (1-5) *</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', $testimonial->rating) }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
            @if($testimonial->avatar)
              <small class="text-muted d-block mt-1">Current: {{ $testimonial->avatar }}</small>
            @endif
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Testimonial *</label>
        <textarea name="testimonial" class="form-control" rows="5" required>{{ old('testimonial', $testimonial->testimonial) }}</textarea>
      </div>
      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
