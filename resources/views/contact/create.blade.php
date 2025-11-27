@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="py-5 fade-in">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="text-center mb-4">
          <span class="badge bg-secondary mb-3 p-2">Get In Touch</span>
          <h2 class="display-6 fw-bold">Let’s build something great</h2>
          <p class="text-muted">Have a project in mind or just want to say hi? Send me a message.</p>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="card shadow-sm">
          <div class="card-body p-4">
            <form method="POST" action="{{ route('contact.store') }}">
              @csrf

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Your Name *</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email *</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Subject *</label>
                  <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Message *</label>
                  <textarea name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                </div>

                <!-- Honeypot field (simple spam prevention) -->
                <div class="d-none">
                  <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="col-12 d-flex justify-content-between align-items-center mt-2">
                  <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
                  <button type="submit" class="btn btn-gradient">
                    <i class="fas fa-paper-plane me-2"></i>Send Message
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
