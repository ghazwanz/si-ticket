<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizer\StoreEventRequest;
use App\Http\Requests\Organizer\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\TicketCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with('category')->where('organizer_id', auth()->id())->latest()->paginate(10);

        return view('organizer.events.index', compact('events'));
    }

    public function create(): View
    {
        $categories = EventCategory::orderBy('name')->get();

        return view('organizer.events.create', compact('categories'));
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $event = Event::create([
                'id' => Str::uuid(),
                'organizer_id' => $request->user()->id,
                'category_id' => $request->string('category_id'),
                'name' => $request->string('name'),
                'slug' => Str::slug($request->string('name')).'-'.Str::random(5),
                'description' => $request->string('description'),
                'venue_name' => $request->string('venue_name'),
                'address' => $request->string('address'),
                'city' => $request->string('city'),
                'event_date' => $request->date('event_date'),
                'start_time' => $request->string('start_time'),
                'end_time' => $request->string('end_time'),
                'status' => $request->string('status'),
                'is_featured' => false,
            ]);

            $this->syncTicketCategories($event, $request->validated('tickets'));
        });

        return redirect()->route('organizer.events.index')->with('status', 'Acara beserta tiket berhasil dibuat.');
    }

    public function edit(string $id): View
    {
        $event = Event::with('category', 'ticketCategories')
            ->where('organizer_id', auth()->id())
            ->findOrFail($id);
        $categories = EventCategory::orderBy('name')->get();

        return view('organizer.events.edit', compact('event', 'categories'));
    }

    public function update(UpdateEventRequest $request, string $id): RedirectResponse
    {
        $event = Event::query()
            ->where('organizer_id', $request->user()->id)
            ->findOrFail($id);

        DB::transaction(function () use ($event, $request): void {
            $event->update([
                'category_id' => $request->string('category_id'),
                'name' => $request->string('name'),
                'description' => $request->string('description'),
                'venue_name' => $request->string('venue_name'),
                'address' => $request->string('address'),
                'city' => $request->string('city'),
                'event_date' => $request->date('event_date'),
                'start_time' => $request->string('start_time'),
                'end_time' => $request->string('end_time'),
                'status' => $request->string('status'),
            ]);

            $event->ticketCategories()->delete();
            $this->syncTicketCategories($event, $request->validated('tickets'));
        });

        return redirect()->route('organizer.events.index')->with('status', 'Perubahan acara berhasil disimpan.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $event = Event::query()
            ->where('organizer_id', auth()->id())
            ->findOrFail($id);

        $event->delete();

        return redirect()->route('organizer.events.index')->with('status', 'Acara berhasil dihapus dari daftar aktif.');
    }

    /**
     * @param  array<int, array{name: string, price: int|string, quota: int|string}>  $tickets
     */
    private function syncTicketCategories(Event $event, array $tickets): void
    {
        foreach ($tickets as $ticket) {
            TicketCategory::create([
                'id' => Str::uuid(),
                'event_id' => $event->id,
                'name' => $ticket['name'],
                'price' => $ticket['price'],
                'quota' => $ticket['quota'],
                'sale_start_at' => now(),
                'sale_end_at' => $event->event_date.' '.$event->end_time,
                'is_active' => true,
            ]);
        }
    }
}
