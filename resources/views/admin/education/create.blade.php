@extends('layouts.admin')

@section('title', 'Add Education')

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
                <h6 class="m-0 font-weight-bold text-primary">Add Education Record</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.education.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution" class="form-label">Institution *</label>
                                <input type="text" class="form-control @error('institution') is-invalid @enderror" 
                                       id="institution" name="institution" value="{{ old('institution') }}" required>
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="degree" class="form-label">Degree *</label>
                                <input type="text" class="form-control @error('degree') is-invalid @enderror" 
                                       id="degree" name="degree" value="{{ old('degree') }}" required>
                                @error('degree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field_of_study" class="form-label">Field of Study *</label>
                                <input type="text" class="form-control @error('field_of_study') is-invalid @enderror" 
                                       id="field_of_study" name="field_of_study" value="{{ old('field_of_study') }}" required>
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
                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="month" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_current" 
                                           id="is_current" value="1" {{ old('is_current') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_current">
                                        I currently study here
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution_logo" class="form-label">Institution Logo</label>
                                <input type="file" class="form-control" id="institution_logo" name="institution_logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', 0) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Add Education</button>
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
</script>
@endsection