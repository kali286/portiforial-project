@extends('layouts.admin')

@section('title', 'Testimonials')

@section('actions')
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Testimonial
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Company</th>
                        <th>Rating</th>
                        <th>Approved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->client_name }}</td>
                            <td>{{ $t->company }}</td>
                            <td>{{ $t->rating }}/5</td>
                            <td>
                                <span class="badge bg-{{ $t->is_approved ? 'success' : 'secondary' }}">{{ $t->is_approved ? 'Yes' : 'No' }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this testimonial?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No testimonials found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $testimonials->links() }}
        </div>
    </div>
</div>
@endsection
