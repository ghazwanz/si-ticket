<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pengguna' => 12842,
            'event_review'   => 12,
            'event_aktif'    => 342,
            'eo_pending'     => 8,
        ];

        $logs = [
            ['icon'=>'✓','color'=>'bg-green-100 text-green-600','action'=>'Event "Jakarta Tech Expo" approved','user'=>'Admin Utama','time'=>'2 mins ago'],
            ['icon'=>'👤','color'=>'bg-purple-100 text-purple-600','action'=>'New EO Registration: Stellar Creative','user'=>'System','time'=>'15 mins ago'],
            ['icon'=>'⚑','color'=>'bg-red-100 text-red-600','action'=>'Flagged review on "Jazz Night"','user'=>'Moderator B','time'=>'42 mins ago'],
            ['icon'=>'✎','color'=>'bg-blue-100 text-blue-600','action'=>'Updated system permissions','user'=>'Super Admin','time'=>'1 hour ago'],
        ];

        $distribusi = [
            ['label'=>'Music & Concerts','pct'=>45,'color'=>'bg-brand'],
            ['label'=>'Conferences','pct'=>30,'color'=>'bg-blue-500'],
            ['label'=>'Sports','pct'=>25,'color'=>'bg-gray-300'],
        ];

        return view('admin.dashboard', compact('stats', 'logs', 'distribusi'));
    }
}

