@extends('layouts.admin')

@section('title', 'Messages')

@section('actions')
    <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="markAllAsRead()">
            <i class="fas fa-envelope-open me-1"></i> Mark All as Read
        </button>
    </div>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Contact Messages</h6>
        <div class="d-flex">
            <input type="text" class="form-control form-control-sm me-2" placeholder="Search messages..." style="width: 200px;">
            <select class="form-select form-select-sm" style="width: 150px;">
                <option value="">All Status</option>
                <option value="unread">Unread</option>
                <option value="read">Read</option>
                <option value="replied">Replied</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr class="{{ $message->status === 'unread' ? 'table-warning' : '' }}">
                        <td>
                            <div class="fw-bold text-dark">{{ $message->name }}</div>
                            <small class="text-muted">{{ $message->email }}</small>
                        </td>
                        <td>{{ Str::limit($message->subject, 50) }}</td>
                        <td>{{ Str::limit($message->message, 80) }}</td>
                        <td>
                            <small>{{ $message->created_at->format('M d, Y') }}</small>
                            <br>
                            <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $message->status === 'unread' ? 'warning' : ($message->status === 'replied' ? 'success' : 'secondary') }}">
                                {{ ucfirst($message->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline">
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
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <p>No messages found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($messages->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function markAllAsRead() {
    if (confirm('Mark all messages as read?')) {
        fetch('{{ route("admin.messages.mark-all-read") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}
</script>
@endsection