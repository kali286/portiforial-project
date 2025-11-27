@extends('layouts.admin')

@section('title', 'Services')

@section('actions')
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Service
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
                        <th>Title</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->icon }}</td>
                            <td>{{ $service->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this service?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">No services found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
