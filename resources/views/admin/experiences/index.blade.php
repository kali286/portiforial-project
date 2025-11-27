@extends('layouts.admin')

@section('title', 'Experiences')

@section('actions')
    <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> New Experience
    </a>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Work Experience</h6>
        <div class="d-flex">
            <input type="text" class="form-control form-control-sm me-2" placeholder="Search experiences..." style="width: 200px;">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Company</th>
                        <th>Position</th>
                        <th>Employment Type</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($experiences as $experience)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($experience->company_logo)
                                    <img src="{{ asset('storage/' . $experience->company_logo) }}" 
                                         class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-building text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $experience->company_name }}</div>
                                    <small class="text-muted">{{ $experience->location }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $experience->position }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($experience->employment_type) }}</span>
                        </td>
                        <td>
                            {{ $experience->start_date->format('M Y') }} - 
                            @if($experience->is_current)
                                <span class="badge bg-success">Present</span>
                            @else
                                {{ $experience->end_date->format('M Y') }}
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $experience->is_current ? 'success' : 'secondary' }}">
                                {{ $experience->is_current ? 'Current' : 'Past' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.experiences.edit', $experience->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.experiences.destroy', $experience->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-briefcase fa-3x mb-3"></i>
                            <p>No experience records found.</p>
                            <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">Add your first experience</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($experiences->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $experiences->links() }}
        </div>
        @endif
    </div>
</div>
@endsection