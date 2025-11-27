@extends('layouts.admin')

@section('title', 'Backups')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <p class="text-muted">Create a fresh backup of the application. You can wire this to your preferred backup system later.</p>
    <form action="{{ route('admin.backups.create') }}" method="POST" class="mb-3">
      @csrf
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-database me-1"></i> Create Backup
      </button>
    </form>

    <div class="alert alert-info">Backup listing not implemented. Integrate with storage or a backup package to display available backups.</div>
  </div>
</div>
@endsection
