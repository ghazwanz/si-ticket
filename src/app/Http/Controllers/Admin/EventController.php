<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventAnalyticsService;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function __construct(
        protected EventService $eventService,
        protected EventAnalyticsService $analyticsService
    ) {}

    public function index(Request $request): View
    {
        $events = $this->eventService->getPaginatedEvents($request->all());

        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event): View
    {
        $event->load([
            'category',
            'organizer.organizerProfile',
            'ticketCategories',
            'merchandiseItems.variants',
            'latestCancellationRequest',
        ]);

        $intelligence = $this->analyticsService->getEventIntelligence($event);

        return view('admin.events.show', compact('event', 'intelligence'));
    }

    public function updateStatus(Request $request, Event $event)
    {
        $allowedStatuses = ['draft', 'published', 'completed', 'cancelled'];

        // Enforce transition rules for published events
        if ($event->status === 'published') {
            $allowedStatuses = ['completed', 'cancelled'];
        }

        $request->validate([
            'status' => 'required|in:'.implode(',', $allowedStatuses),
        ]);

        $this->eventService->updateEventStatus($event, $request->status);

        return back()->with('status', 'Status event berhasil diperbarui.');
    }
}
