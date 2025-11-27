@extends('layouts.admin')

@section('title', 'Education')

@section('actions')
    <a href="{{ route('admin.education.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> New Education
    </a>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Education History</h6>
        <div class="d-flex">
            <input type="text" class="form-control form-control-sm me-2" placeholder="Search education..." style="width: 200px;">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Institution</th>
                        <th>Degree</th>
                        <th>Field of Study</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($education as $edu)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($edu->institution_logo)
                                    <img src="{{ asset('storage/' . $edu->institution_logo) }}" 
                                         class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-university text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $edu->institution }}</div>
                                    <small class="text-muted">{{ $edu->location }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $edu->degree }}</div>
                        </td>
                        <td>{{ $edu->field_of_study }}</td>
                        <td>
                            {{ $edu->start_date->format('M Y') }} - 
                            @if($edu->is_current)
                                <span class="badge bg-success">Present</span>
                            @else
                                {{ $edu->end_date->format('M Y') }}
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $edu->is_current ? 'success' : 'secondary' }}">
                                {{ $edu->is_current ? 'Current' : 'Completed' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.education.edit', $edu->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.education.destroy', $edu->id) }}" method="POST" class="d-inline">
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
                            <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                            <p>No education records found.</p>
                            <a href="{{ route('admin.education.create') }}" class="btn btn-primary">Add your first education record</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($education->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $education->links() }}
        </div>
        @endif
    </div>
</div>
@endsection