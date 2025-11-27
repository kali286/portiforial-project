<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::where('status', '!=', 'archived')
            ->latest()
            ->paginate(10);
            
        return view('admin.messages.index', compact('messages'));
    }

    public function archived()
    {
        $messages = ContactMessage::where('status', 'archived')
            ->latest()
            ->paginate(10);
            
        return view('admin.messages.archived', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read when viewing
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }
        
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'read']);

        return redirect()->back()
            ->with('success', 'Message marked as read.');
    }

    public function markAsUnread($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'unread']);

        return redirect()->back()
            ->with('success', 'Message marked as unread.');
    }

    public function archive($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'archived']);

        return redirect()->back()
            ->with('success', 'Message archived successfully.');
    }

    public function restore($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'read']);

        return redirect()->back()
            ->with('success', 'Message restored successfully.');
    }

    public function markAllRead()
    {
        ContactMessage::where('status', 'unread')->update(['status' => 'read']);
        return response()->noContent();
    }

    public function reply($id, Request $request)
    {
        $request->validate([
            'admin_note' => 'nullable|string|max:5000',
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->update([
            'admin_note' => $request->input('admin_note')
        ]);

        return redirect()->back()->with('success', 'Reply/notes saved successfully.');
    }

    public function markAsReplied($id, Request $request)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'replied']);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->noContent();
        }

        return redirect()->back()->with('success', 'Message marked as replied.');
    }
}