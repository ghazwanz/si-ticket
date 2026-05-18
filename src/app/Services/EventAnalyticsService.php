<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Collection;

class EventAnalyticsService
{
    /**
     * Get comprehensive analytics for a specific event.
     */
    public function getEventIntelligence(Event $event): array
    {
        return [
            'revenue' => $this->getRevenueStats($event),
            'ticketing' => $this->getTicketingStats($event),
            'merchandise' => $this->getMerchandiseStats($event),
            'activity' => $this->getRecentActivity($event),
        ];
    }

    /**
     * Calculate revenue-related statistics.
     */
    public function getRevenueStats(Event $event): array
    {
        $totalRevenue = $event->orders()
            ->where('status', 'paid')
            ->sum('total_amount');

        // Assuming 10% platform fee for demonstration
        $platformFee = $totalRevenue * 0.10;
        $netPayout = $totalRevenue - $platformFee;

        return [
            'total_gross' => $totalRevenue,
            'platform_fee' => $platformFee,
            'payout_projection' => $netPayout,
            'formatted_gross' => 'Rp '.number_format($totalRevenue, 0, ',', '.'),
        ];
    }

    /**
     * Aggregate ticketing performance.
     */
    public function getTicketingStats(Event $event): array
    {
        $categories = $event->ticketCategories;

        $totalQuota = $categories->sum('quota');
        $totalSold = $categories->sum('sold_count');
        $fillRate = $totalQuota > 0 ? ($totalSold / $totalQuota) * 100 : 0;

        return [
            'total_sold' => $totalSold,
            'total_quota' => $totalQuota,
            'fill_rate' => round($fillRate, 1),
            'categories' => $categories->map(fn ($cat) => [
                'name' => $cat->name,
                'price' => $cat->price,
                'sold' => $cat->sold_count,
                'quota' => $cat->quota,
                'is_sold_out' => $cat->sold_count >= $cat->quota,
            ]),
        ];
    }

    /**
     * Aggregate merchandise performance.
     */
    public function getMerchandiseStats(Event $event): array
    {
        $items = $event->merchandiseItems()->with('variants')->get();

        return [
            'total_items' => $items->count(),
            'items' => $items->map(fn ($item) => [
                'name' => $item->name,
                'base_price' => $item->base_price,
                'total_stock' => $item->variants->sum('stock'),
                'is_available' => $item->is_available,
            ]),
        ];
    }

    /**
     * Get recent orders and events.
     */
    public function getRecentActivity(Event $event): Collection
    {
        return $event->orders()
            ->with('user')
            ->latest()
            ->limit(10)
            ->get();
    }
}
