@extends('layouts.app')

@section('title', 'Skills')

@section('content')
<section class="py-5 bg-light fade-in">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge bg-secondary mb-3 p-2">My Skills</span>
      <h2 class="display-5 fw-bold mb-3">Technical Expertise</h2>
      <p class="lead text-muted">Technologies and tools I work with</p>
    </div>

    <div class="row">
      @forelse($skills as $skill)
      <div class="col-lg-6 mb-4">
        <div class="card p-4 h-100 glass card-hover">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
              @if($skill->icon)
              <i class="{{ $skill->icon }} me-3 fa-2x" style="color: {{ $skill->color ?? '#6366f1' }}"></i>
              @else
              <i class="fas fa-code me-3 fa-2x text-primary"></i>
              @endif
              <h5 class="mb-0 fw-bold">{{ $skill->name }}</h5>
            </div>
            <span class="badge bg-primary">{{ $skill->level }}%</span>
          </div>
          <div class="progress" style="height: 12px;">
            <div class="progress-bar" role="progressbar" style="width: {{ $skill->level }}%"></div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center text-muted">
        <i class="fas fa-info-circle me-2"></i>No skills available yet.
      </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
