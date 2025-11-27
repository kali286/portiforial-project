@extends('layouts.admin')

@section('title', 'Message from ' . $message->name)

@section('actions')
    <div class="btn-group">
        @if($message->status === 'unread')
        <form action="{{ route('admin.messages.mark-read', $message->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-envelope-open me-1"></i> Mark as Read
            </button>
        </form>
        @endif
        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash me-1"></i> Delete
            </button>
        </form>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Message Details</h6>
                <span class="badge bg-{{ $message->status === 'unread' ? 'warning' : ($message->status === 'replied' ? 'success' : 'secondary') }}">
                    {{ ucfirst($message->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="text-dark">{{ $message->subject }}</h4>
                    <div class="text-muted mb-3">
                        <i class="fas fa-clock me-1"></i> 
                        {{ $message->created_at->format('F j, Y \\a\\t g:i A') }}
                        ({{ $message->created_at->diffForHumans() }})
                    </div>
                </div>

                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>From:</strong>
                            <p class="text-dark">{{ $message->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Email:</strong>
                            <p>
                                <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                    {{ $message->email }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <strong>Message:</strong>
                    <div class="border rounded p-3 bg-light mt-2">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>

                @if($message->admin_note)
                <div class="mb-4">
                    <strong>Admin Note:</strong>
                    <div class="border rounded p-3 bg-info bg-opacity-10 mt-2">
                        {{ $message->admin_note }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Reply Form -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reply to Message</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.messages.reply', $message->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="admin_note" class="form-label">Admin Notes / Reply</label>
                        <textarea class="form-control" id="admin_note" name="admin_note" rows="4" 
                                  placeholder="Add internal notes or prepare a reply...">{{ old('admin_note', $message->admin_note) }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">Save Notes</button>
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                               class="btn btn-success">
                                <i class="fas fa-reply me-1"></i> Reply via Email
                            </a>
                        </div>
                        <button type="button" class="btn btn-success" onclick="markAsReplied()">
                            <i class="fas fa-check me-1"></i> Mark as Replied
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                       class="btn btn-outline-primary">
                        <i class="fas fa-reply me-1"></i> Reply via Email
                    </a>
                    
                    @if($message->status !== 'replied')
                    <form action="{{ route('admin.messages.mark-replied', $message->id) }}" method="POST" class="d-grid">
                        @csrf
                        <button type="submit" class="btn btn-outline-success">
                            <i class="fas fa-check me-1"></i> Mark as Replied
                        </button>
                    </form>
                    @endif

                    @if($message->status === 'unread')
                    <form action="{{ route('admin.messages.mark-read', $message->id) }}" method="POST" class="d-grid">
                        @csrf
                        <button type="submit" class="btn btn-outline-info">
                            <i class="fas fa-envelope-open me-1"></i> Mark as Read
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Message Information</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Status</span>
                        <span class="badge bg-{{ $message->status === 'unread' ? 'warning' : ($message->status === 'replied' ? 'success' : 'secondary') }}">
                            {{ ucfirst($message->status) }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Received</span>
                        <small class="text-muted">{{ $message->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Time</span>
                        <small class="text-muted">{{ $message->created_at->format('g:i A') }}</small>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>IP Address</span>
                        <small class="text-muted">{{ $message->ip_address ?? 'N/A' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function markAsReplied() {
    if (confirm('Mark this message as replied?')) {
        fetch('{{ route("admin.messages.mark-replied", $message->id) }}', {
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