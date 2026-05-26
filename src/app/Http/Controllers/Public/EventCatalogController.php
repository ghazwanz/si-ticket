<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()
            ->with(['category', 'organizer'])
            ->whereIn('status', ['published', 'awaiting_cancellation', 'completed']) // Exclude cancelled and draft
            ->orderBy('event_date')
            ->orderBy('start_time');

        // Text Search (Fulltext index on name, description)
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->whereFullText(['name', 'description'], $search)
                    ->orWhere('venue_name', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($category = $request->input('category')) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($city = $request->input('city')) {
            $query->where('city', $city);
        }

        if ($startDate = $request->input('start_date')) {
            $query->whereDate('event_date', '>=', $startDate);
        }

        if ($endDate = $request->input('end_date')) {
            $query->whereDate('event_date', '<=', $endDate);
        }

        if ($status = $request->input('status')) {
            if ($status === 'upcoming') {
                $query->where('status', 'published');
            } elseif ($status === 'suspended') {
                $query->where('status', 'awaiting_cancellation');
            } elseif ($status === 'completed') {
                $query->where('status', 'completed');
            }
        }

        $events = $query->paginate(12)->withQueryString();
        $eventCategories = EventCategory::all();

        // Get unique cities for filter dropdown
        $cities = Event::whereIn('status', ['published', 'awaiting_cancellation', 'completed'])
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('events.index', [
            'events' => $events,
            'eventCategories' => $eventCategories,
            'cities' => $cities,
        ]);
    }

    public function show(string $slug)
    {
        $now = now();
        $event = Event::with([
            'category',
            'organizer',
            'ticketCategories' => function ($query) use ($now) {
                $query->where('is_active', true)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('sale_start_at')
                            ->orWhere('sale_start_at', '<=', $now);
                    })
                    ->where(function ($q) use ($now) {
                        $q->whereNull('sale_end_at')
                            ->orWhere('sale_end_at', '>=', $now);
                    });
            },
            'merchandiseItems' => function ($query) {
                $query->where('is_available', true);
            },
            'merchandiseItems.variants',
        ])->where('slug', $slug)->firstOrFail();

        // Cancellation Logic (Task 3.6)
        if ($event->status === 'cancelled') {
            $hasOrder = false;

            if (auth()->check()) {
                $hasOrder = auth()->user()->orders()
                    ->where('event_id', $event->id)
                    ->exists();
            }

            if (! $hasOrder) {
                abort(404);
            }
        }

        // "Nearly Sold Out" logic (Task 3.2): < 10% quota remaining
        $totalQuota = $event->ticketCategories->sum('quota');
        $totalSold = $event->ticketCategories->sum('sold_count');
        $isNearlySoldOut = false;

        if ($totalQuota > 0) {
            $remainingPercentage = (($totalQuota - $totalSold) / $totalQuota) * 100;
            if ($remainingPercentage > 0 && $remainingPercentage < 10) {
                $isNearlySoldOut = true;
            }
        }

        return view('events.show', [
            'event' => $event,
            'isNearlySoldOut' => $isNearlySoldOut,
        ]);
    }
}
