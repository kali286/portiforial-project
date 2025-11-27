@extends('layouts.app')

@section('title', $service->title)

@section('content')
<section class="py-5 fade-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mb-4">
        <div class="card p-4 card-hover">
          <div class="d-flex align-items-center mb-3">
            <i class="{{ $service->icon ?: 'fas fa-cog' }} fa-2x text-primary me-3"></i>
            <h1 class="h3 mb-0">{{ $service->title }}</h1>
          </div>
          <div class="mb-3 text-muted">{!! nl2br(e($service->description)) !!}</div>
          @if($service->features)
          <h5 class="mt-4">Features</h5>
          <ul class="list-unstyled mt-2">
            @foreach(preg_split('/\r?\n|,/', $service->features) as $feature)
              @if(trim($feature) !== '')
                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ trim($feature) }}</li>
              @endif
            @endforeach
          </ul>
          @endif
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card p-3">
          <h5 class="mb-3">Other Services</h5>
          @forelse($otherServices as $s)
            <a class="d-block text-decoration-none mb-2" href="{{ route('services.show', $s->id) }}">
              <i class="{{ $s->icon ?: 'fas fa-cog' }} text-primary me-2"></i>{{ $s->title }}
            </a>
          @empty
            <div class="text-muted">No other services.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
