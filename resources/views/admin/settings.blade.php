@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <form action="{{ route('admin.settings.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Site Name</label>
            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Contact Email</label>
            <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}">
          </div>
        </div>
      </div>

      <div class="form-check form-switch mb-4">
        <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" {{ (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1') ? 'checked' : '' }}>
        <label class="form-check-label" for="maintenance_mode">Maintenance Mode</label>
      </div>

      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Settings</button>
      </div>
    </form>
  </div>
</div>
@endsection
