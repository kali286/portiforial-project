@extends('layouts.app')

@section('title', 'Services')

@section('content')
<section class="py-5 bg-light fade-in">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge bg-secondary mb-3 p-2">What I Offer</span>
      <h2 class="display-5 fw-bold mb-3">Services</h2>
      <p class="lead text-muted">Professional services tailored to your needs</p>
    </div>

    <div class="row">
      @forelse($services as $service)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 card-hover p-3">
          <div class="d-flex align-items-center mb-3">
            <i class="{{ $service->icon ?: 'fas fa-cog' }} fa-2x text-primary me-3"></i>
            <h5 class="mb-0">{{ $service->title }}</h5>
          </div>
          <p class="text-muted">{{ \Illuminate\Support\Str::limit($service->description, 140) }}</p>
          <div class="mt-auto d-flex justify-content-between align-items-center">
            <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary btn-sm">Learn More</a>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center text-muted">
        <i class="fas fa-info-circle me-2"></i>No services available yet.
      </div>
      @endforelse
    </div>
  </div>
  </section>
@endsection
