@extends('layouts.admin')

@section('title', 'Edit Education')

@section('actions')
    <a href="{{ route('admin.education.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Education Record</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.education.update', $education->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution" class="form-label">Institution *</label>
                                <input type="text" class="form-control @error('institution') is-invalid @enderror" 
                                       id="institution" name="institution" value="{{ old('institution', $education->institution) }}" required>
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $education->location) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="degree" class="form-label">Degree *</label>
                                <input type="text" class="form-control @error('degree') is-invalid @enderror" 
                                       id="degree" name="degree" value="{{ old('degree', $education->degree) }}" required>
                                @error('degree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field_of_study" class="form-label">Field of Study *</label>
                                <input type="text" class="form-control @error('field_of_study') is-invalid @enderror" 
                                       id="field_of_study" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}" required>
                                @error('field_of_study')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date *</label>
                                <input type="month" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date', $education->start_date->format('Y-m')) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="month" class="form-control" id="end_date" name="end_date" 
                                       value="{{ old('end_date', $education->end_date ? $education->end_date->format('Y-m') : '') }}"
                                       {{ $education->is_current ? 'disabled' : '' }}>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_current" 
                                           id="is_current" value="1" {{ old('is_current', $education->is_current) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_current">
                                        I currently study here
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $education->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution_logo" class="form-label">Institution Logo</label>
                                @if($education->institution_logo)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $education->institution_logo) }}" 
                                             alt="Current logo" class="img-fluid rounded mb-2" style="max-height: 100px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo" value="1">
                                            <label class="form-check-label" for="remove_logo">
                                                Remove current logo
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="institution_logo" name="institution_logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', $education->sort_order) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Education</button>
                        <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">Cancel</a>
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

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const isCurrent = document.getElementById('is_current');
    const endDateField = document.getElementById('end_date');
    if (isCurrent.checked) {
        endDateField.disabled = true;
    }
});
</script>
@endsection