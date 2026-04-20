<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventOversightController extends Controller
{
    private function events(): array
    {
        return [
            ['id'=>1,'emoji'=>'🎵','bg'=>'from-purple-900 to-indigo-900','nama'=>'Neo-Soul Night Vol. 4','tanggal'=>'24 Sep 2024','penyelenggara'=>'Vibe Creators Co.','tier'=>'Gold Partner','kategori'=>'KONSER','status'=>'REVIEW','status_color'=>'bg-orange-100 text-orange-600'],
            ['id'=>2,'emoji'=>'💻','bg'=>'from-blue-900 to-cyan-900','nama'=>'Tech Summit 2024','tanggal'=>'12 Okt 2024','penyelenggara'=>'InnoVent Indonesia','tier'=>'New EO','kategori'=>'WEBINAR','status'=>'AKTIF','status_color'=>'bg-green-100 text-green-600'],
            ['id'=>3,'emoji'=>'🍜','bg'=>'from-yellow-900 to-orange-900','nama'=>'Bazaar Kuliner Nusantara','tanggal'=>'05 Nov 2024','penyelenggara'=>'PT. Rasa Nusantara','tier'=>'Silver Partner','kategori'=>'FESTIVAL','status'=>'DITOLAK','status_color'=>'bg-red-100 text-red-600'],
        ];
    }

    public function index()
    {
        $events = collect($this->events());
        return view('admin.eventOversight', compact('events'));
    }

    public function approve($id)
    {
        // TODO: update database
        return back()->with('success', "Event #$id berhasil dipublikasikan.");
    }

    public function reject(Request $request, $id)
    {
        // TODO: update database with rejection reason
        return back()->with('success', "Event #$id ditolak.");
    }
}
