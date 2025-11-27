@extends('layouts.admin')

@section('title', 'Skills')

@section('actions')
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Skill
    </a>
    <a href="{{ route('admin.skills.reorder') }}" class="btn btn-secondary">
        <i class="fas fa-sort"></i> Reorder
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
                        <th>Name</th>
                        <th>Level</th>
                        <th>Icon</th>
                        <th>Color</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr>
                            <td>{{ $skill->id }}</td>
                            <td>{{ $skill->name }}</td>
                            <td>{{ $skill->level }}%</td>
                            <td>{{ $skill->icon }}</td>
                            <td>
                                @if($skill->color)
                                    <span class="badge" style="background: {{ $skill->color }}">&nbsp;&nbsp;</span>
                                @endif
                            </td>
                            <td>{{ $skill->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this skill?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No skills found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $skills->links() }}
        </div>
    </div>
    </div>
@endsection
