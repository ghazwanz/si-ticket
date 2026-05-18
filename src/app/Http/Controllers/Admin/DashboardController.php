<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Platform Core Statistics
        $stats = [
            'total_pengguna' => User::count(),
            'event_review' => Event::where('status', 'pending')->count(),
            'event_aktif' => Event::where('status', 'published')->count(),
            'eo_pending' => User::where('role', UserRole::Organizer)->where('is_active', false)->count(),
        ];

        // Analytics: Last 30 days transactions
        $days = collect(range(29, 0))->map(fn ($i) => now()->subDays($i)->format('Y-m-d'));

        $transactions = Order::query()
            ->where('status', 'paid')
            ->where('paid_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(paid_at) as date, SUM(total_amount) as total, COUNT(*) as count')
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $analytics = [
            'labels' => $days->map(fn ($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'revenue' => $days->map(fn ($date) => $transactions->has($date) ? (int) $transactions[$date]->total : 0)->toArray(),
            'volume' => $days->map(fn ($date) => $transactions->has($date) ? (int) $transactions[$date]->count : 0)->toArray(),
        ];

        // Temporary Logs (Can be migrated to actual ActivityLog later)
        $logs = [
            ['icon' => '✓', 'color' => 'bg-green-100 text-green-600', 'action' => 'Event "Jakarta Tech Expo" approved', 'user' => 'Admin Utama', 'time' => '2 mins ago'],
            ['icon' => '👤', 'color' => 'bg-purple-100 text-purple-600', 'action' => 'New EO Registration: Stellar Creative', 'user' => 'System', 'time' => '15 mins ago'],
            ['icon' => '⚑', 'color' => 'bg-red-100 text-red-600', 'action' => 'Flagged review on "Jazz Night"', 'user' => 'Moderator B', 'time' => '42 mins ago'],
            ['icon' => '✎', 'color' => 'bg-blue-100 text-blue-600', 'action' => 'Updated system permissions', 'user' => 'Super Admin', 'time' => '1 hour ago'],
        ];

        // Category Distribution
        $categories = EventCategory::withCount('events')->get();
        $totalEvents = $categories->sum('events_count');

        $distribusi = $categories->map(function ($cat) use ($totalEvents) {
            return [
                'label' => $cat->name,
                'pct' => $totalEvents > 0 ? round(($cat->events_count / $totalEvents) * 100) : 0,
                'color' => 'bg-violet-600',
            ];
        })->take(3)->toArray();

        return view('admin.dashboard', compact('stats', 'logs', 'distribusi', 'analytics'));
    }
}
