<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['organizer', 'category'])->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function updateStatus(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|in:draft,published,completed,cancelled',
        ]);

        $event->update([
            'status' => $request->status
        ]);

        return back()->with('status', 'Status event berhasil diperbarui.');
    }
}
