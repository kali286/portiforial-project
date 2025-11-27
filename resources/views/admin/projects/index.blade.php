@extends('layouts.admin')

@section('title', 'Projects Management')
@section('page-title', 'Projects Management')

@section('actions')
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Project
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $project->category->name }}</span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $project->status ? 'success' : 'warning' }}">
                                {{ $project->status ? 'Active' : 'Draft' }}
                            </span>
                        </td>
                        <td>
                            @if($project->featured)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('projects.show', $project->id) }}" 
                                   class="btn btn-info" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" 
                                   class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection