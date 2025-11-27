@extends('layouts.admin')

@section('title', 'Archived Messages')

@section('content')
<div class="card shadow">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>From</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($messages as $message)
          <tr>
            <td>
              <div class="fw-bold">{{ $message->name }}</div>
              <small class="text-muted">{{ $message->email }}</small>
            </td>
            <td>{{ Str::limit($message->subject, 60) }}</td>
            <td>
              <small>{{ $message->created_at->format('M d, Y H:i') }}</small>
            </td>
            <td>
              <div class="btn-group btn-group-sm">
                <form action="{{ route('admin.messages.restore', $message->id) }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-success" title="Restore"><i class="fas fa-undo"></i></button>
                </form>
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this message?')" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="4" class="text-center text-muted">No archived messages.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center">
      {{ $messages->links() }}
    </div>
  </div>
</div>
@endsection
