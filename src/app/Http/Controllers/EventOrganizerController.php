<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventOrganizerController extends Controller
{
    /**
     * Data dummy organizer
     */
    private function dummyOrganizer(): object
    {
        return (object)[
            'id'           => 1,
            'nama'         => 'Pitoe Creative Network',
            'bio'          => 'Kurator pengalaman premium yang menjembatani inovasi teknologi dan keajaiban musikal. Menghadirkan acara berskala internasional dengan kualitas produksi tanpa kompromi.',
            'avatar'       => null,
            'banner'       => null,
            'terverifikasi'=> true,
            'event_aktif'  => 24,
            'pengikut'     => 12500,
            'rating'       => 4.9,
        ];
    }

    /**
     * Data dummy events
     */
    private function dummyEvents(string $tab): \Illuminate\Support\Collection
    {
        $aktif = collect([
            (object)[
                'id'       => 1,
                'nama'     => 'Summer Tech Summit',
                'kategori' => 'Tech',
                'tanggal'  => '2024-08-15',
                'lokasi'   => 'Jakarta Convention Center',
                'gambar'   => null,
            ],
            (object)[
                'id'       => 2,
                'nama'     => 'Jazz Night Under the Stars',
                'kategori' => 'Music',
                'tanggal'  => '2024-08-22',
                'lokasi'   => 'Sky Garden Rooftop',
                'gambar'   => null,
            ],
            (object)[
                'id'       => 3,
                'nama'     => 'AI & Future of Design',
                'kategori' => 'Workshop',
                'tanggal'  => '2024-09-05',
                'lokasi'   => config('app.name') . ' Studio Lab',
                'gambar'   => null,
            ],
        ]);

        $lampau = collect([
            (object)[
                'id'       => 4,
                'nama'     => 'Neon Nights Festival 2023',
                'kategori' => 'Music',
                'tanggal'  => '2023-12-10',
                'lokasi'   => 'Gelora Bung Karno',
                'gambar'   => null,
            ],
            (object)[
                'id'       => 5,
                'nama'     => 'Coffee & Culture Expo',
                'kategori' => 'Lifestyle',
                'tanggal'  => '2024-05-05',
                'lokasi'   => 'Grand Ballroom Jakarta',
                'gambar'   => null,
            ],
        ]);

        return $tab === 'lampau' ? $lampau : $aktif;
    }

    /**
     * Data dummy testimonials
     */
    private function dummyTestimonials(): \Illuminate\Support\Collection
    {
        return collect([
            (object)[
                'rating'   => 5,
                'komentar' => 'Pengalaman terbaik mengikuti event teknologi. Organisasinya sangat rapi, pembicaranya berkualitas, dan networkingnya luar biasa.',
                'nama'     => 'Adrian Wijaya',
                'jabatan'  => 'Product Manager, Meta',
                'avatar'   => null,
            ],
            (object)[
                'rating'   => 5,
                'komentar' => 'Konser Jazz paling intim yang pernah saya datangi. Sound system dan pemilihan venue selalu menjadi kekuatan ' . config('app.name') . ' Productions.',
                'nama'     => 'Siska Pratama',
                'jabatan'  => 'Music Enthusiast',
                'avatar'   => null,
            ],
        ]);
    }

    /**
     * Tampilkan profil organizer.
     */
    public function show(Request $request, $id)
    {
        $organizer    = $this->dummyOrganizer();
        $tab          = $request->query('tab', 'aktif');
        $events       = $this->dummyEvents($tab);
        $testimonials = $this->dummyTestimonials();

        return view('profileEventOrganizer', compact('organizer', 'events', 'testimonials'));
    }

    /**
     * Ikuti organizer.
     */
    public function ikuti(Request $request, $id)
    {
        // TODO: simpan ke database
        return back()->with('success', 'Berhasil mengikuti organizer.');
    }

    /**
     * Halaman hubungi organizer (placeholder).
     */
    public function hubungi($id)
    {
        // TODO: arahkan ke form kontak / WhatsApp / email
        return back()->with('info', 'Fitur hubungi segera hadir.');
    }
}