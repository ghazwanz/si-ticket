<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->where('organizer_id', auth()->id())->latest()->paginate(10);
        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        $categories = EventCategory::orderBy('name')->get();
        return view('organizer.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:event_categories,id',
            'description' => 'required|string',
            'venue_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:draft,published',
            'tickets' => 'required|array|min:1',
            'tickets.*.name' => 'required|string|max:255',
            'tickets.*.price' => 'required|numeric|min:0',
            'tickets.*.quota' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $event = Event::create([
                'id' => Str::uuid(),
                'organizer_id' => auth()->id(),
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->name) . '-' . Str::random(5),
                'description' => $request->description,
                'venue_name' => $request->venue_name,
                'address' => $request->address,
                'city' => $request->city,
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => $request->status,
                'is_featured' => false,
            ]);

            foreach ($request->tickets as $ticket) {
                TicketCategory::create([
                    'id' => Str::uuid(),
                    'event_id' => $event->id,
                    'name' => $ticket['name'],
                    'price' => $ticket['price'],
                    'quota' => $ticket['quota'],
                    'sale_start_at' => now(),
                    'sale_end_at' => $event->event_date . ' ' . $event->end_time,
                    'is_active' => true,
                ]);
            }
        });

        return redirect()->route('organizer.events.index')->with('status', 'Event beserta tiket berhasil dibuat!');
    }
}
