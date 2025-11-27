@extends('layouts.app')

@section('title', 'Testimonials')

@section('content')
<section class="py-5 bg-light fade-in">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge bg-secondary mb-3 p-2">What Clients Say</span>
      <h2 class="display-5 fw-bold mb-3">Testimonials</h2>
      <p class="lead text-muted">Feedback from clients I’ve worked with</p>
    </div>

    <div class="row">
      @forelse($testimonials as $t)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 card-hover p-4">
          <div class="d-flex align-items-center mb-3">
            <img src="{{ $t->avatar ? asset('storage/'.$t->avatar) : 'https://via.placeholder.com/64x64?text=+' }}" alt="Avatar" class="rounded-circle me-3" width="56" height="56">
            <div>
              <h6 class="mb-0">{{ $t->client_name }}</h6>
              <small class="text-muted">{{ trim(($t->position ?: '').' '.($t->company ? '· '.$t->company : '')) }}</small>
            </div>
          </div>
          <p class="text-muted">“{{ $t->testimonial }}”</p>
          <div>
            @for ($i = 1; $i <= 5; $i++)
              <i class="fa{{ $i <= $t->rating ? 's' : 'r' }} fa-star text-warning"></i>
            @endfor
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center text-muted">
        <i class="fas fa-info-circle me-2"></i>No testimonials yet.
      </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
