@extends('layouts.admin')

@section('title', 'Categories')

@section('actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-1"></i> New Category
    </a>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
        <div class="d-flex">
            <input type="text" class="form-control form-control-sm me-2" placeholder="Search categories..." style="width: 200px;">
            <select class="form-select form-select-sm" style="width: 150px;">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Color</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $category->name }}</div>
                            <small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if($category->color)
                            <div class="d-flex align-items-center">
                                <div class="color-swatch me-2" style="background-color: {{ $category->color }}; width: 20px; height: 20px; border-radius: 50%;"></div>
                                <small>{{ $category->color }}</small>
                            </div>
                            @else
                            <span class="text-muted">No color</span>
                            @endif
                        </td>
                        <td>{{ $category->sort_order }}</td>
                        <td>
                            <span class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
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
                            <i class="fas fa-folder fa-3x mb-3"></i>
                            <p>No categories found.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create your first category</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($categories->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection