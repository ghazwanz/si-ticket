<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventService
{
    /**
     * Get a paginated list of events with filters, search, and sorting.
     */
    public function getPaginatedEvents(array $filters): LengthAwarePaginator
    {
        $status = $filters['status'] ?? null;
        $search = $filters['search'] ?? null;
        $sort = $filters['sort'] ?? 'created_at';
        $order = $filters['order'] ?? 'desc';

        return Event::with(['organizer', 'category'])
            ->when($status && $status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($cq) use ($search) {
                            $cq->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when(in_array($sort, ['name', 'event_date', 'status', 'city']), function ($query) use ($sort, $order) {
                return $query->orderBy($sort, $order === 'asc' ? 'asc' : 'desc');
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Update the status of an event.
     */
    public function updateEventStatus(Event $event, string $status): Event
    {
        // Guard against invalid transitions from published status
        if ($event->status === 'published' && ! in_array($status, ['completed', 'cancelled'])) {
            throw new \InvalidArgumentException('Published events can only be moved to completed or cancelled.');
        }

        $event->update([
            'status' => $status,
        ]);

        return $event;
    }
}
