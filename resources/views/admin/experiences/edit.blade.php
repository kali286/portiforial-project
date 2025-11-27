@extends('layouts.admin')

@section('title', 'Edit Experience')

@section('actions')
    <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Work Experience</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name *</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                       id="company_name" name="company_name" value="{{ old('company_name', $experience->company_name) }}" required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position *</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                       id="position" name="position" value="{{ old('position', $experience->position) }}" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="employment_type" class="form-label">Employment Type</label>
                                <select class="form-select" id="employment_type" name="employment_type">
                                    <option value="full-time" {{ old('employment_type', $experience->employment_type) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="part-time" {{ old('employment_type', $experience->employment_type) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="contract" {{ old('employment_type', $experience->employment_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="freelance" {{ old('employment_type', $experience->employment_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="internship" {{ old('employment_type', $experience->employment_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $experience->location) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date *</label>
                                <input type="month" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m')) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="month" class="form-control" id="end_date" name="end_date" 
                                       value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m') : '') }}"
                                       {{ $experience->is_current ? 'disabled' : '' }}>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_current" 
                                           id="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_current">
                                        I currently work here
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="responsibilities" class="form-label">Responsibilities</label>
                        <textarea class="form-control" id="responsibilities" name="responsibilities" rows="4">{{ old('responsibilities', $experience->responsibilities) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company_logo" class="form-label">Company Logo</label>
                                @if($experience->company_logo)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $experience->company_logo) }}" 
                                             alt="Current logo" class="img-fluid rounded mb-2" style="max-height: 100px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo" value="1">
                                            <label class="form-check-label" for="remove_logo">
                                                Remove current logo
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', $experience->sort_order) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Experience</button>
                        <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('is_current').addEventListener('change', function() {
    const endDateField = document.getElementById('end_date');
    if (this.checked) {
        endDateField.disabled = true;
        endDateField.value = '';
    } else {
        endDateField.disabled = false;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const isCurrent = document.getElementById('is_current');
    const endDateField = document.getElementById('end_date');
    if (isCurrent.checked) {
        endDateField.disabled = true;
    }
});
</script>
@endsection