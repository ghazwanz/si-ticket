<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Data dummy pesanan (dipakai bersama index & show)
     */
    private function dummyData(): array
    {
        return [
            (object)[
                'id'                 => 1,
                'kode_order'         => 'VNT-88294401-2024',
                'nama_event'         => 'Neon Nights Festival 2024',
                'tanggal'            => '2024-05-14',
                'jam'                => '14:30',
                'gambar'             => null,
                'total'              => 2411500,
                'subtotal_tiket'     => 1500000,
                'subtotal_merch'     => 650000,
                'pajak'              => 236500,
                'biaya_layanan'      => 25000,
                'status'             => 'paid',
                'metode_pembayaran'  => 'BCA Virtual Account',
                'tikets'             => [
                    (object)[
                        'nama'          => 'Ahmad Rizky',
                        'id_tiket'      => '10029331-A',
                        'kategori'      => 'Festival A',
                        'sudah_checkin' => false,
                        'url_etiket'    => '#',
                    ],
                    (object)[
                        'nama'          => 'Siti Aminah',
                        'id_tiket'      => '10029331-B',
                        'kategori'      => 'Festival A',
                        'sudah_checkin' => true,
                        'url_etiket'    => '#',
                    ],
                ],
                'merchandises'       => [
                    (object)[
                        'nama'          => 'Venture Exclusive T-Shirt 2024',
                        'varian'        => 'XL - Black',
                        'qty'           => 1,
                        'gambar'        => null,
                        'sudah_diambil' => false,
                        'url_qr'        => '#',
                    ],
                    (object)[
                        'nama'          => 'Official Tour Hoodie',
                        'varian'        => 'L - Charcoal',
                        'qty'           => 1,
                        'gambar'        => null,
                        'sudah_diambil' => true,
                        'url_qr'        => '#',
                    ],
                ],
            ],
            (object)[
                'id'                 => 2,
                'kode_order'         => 'VEN-883042',
                'nama_event'         => 'Design Masterclass: Vol 3',
                'tanggal'            => '2024-07-15',
                'jam'                => '09:00',
                'gambar'             => null,
                'total'              => 1250000,
                'subtotal_tiket'     => 1250000,
                'subtotal_merch'     => 0,
                'pajak'              => 137500,
                'biaya_layanan'      => 15000,
                'status'             => 'pending',
                'metode_pembayaran'  => 'Mandiri Virtual Account',
                'tikets'             => [
                    (object)[
                        'nama'          => 'Budi Santoso',
                        'id_tiket'      => '10029332-A',
                        'kategori'      => 'Regular',
                        'sudah_checkin' => false,
                        'url_etiket'    => '#',
                    ],
                ],
                'merchandises'       => [],
            ],
            (object)[
                'id'                 => 3,
                'kode_order'         => 'VEN-879122',
                'nama_event'         => 'Coffee & Culture Expo',
                'tanggal'            => '2024-05-05',
                'jam'                => '10:00',
                'gambar'             => null,
                'total'              => 150000,
                'subtotal_tiket'     => 150000,
                'subtotal_merch'     => 0,
                'pajak'              => 16500,
                'biaya_layanan'      => 10000,
                'status'             => 'cancelled',
                'metode_pembayaran'  => 'GoPay',
                'tikets'             => [
                    (object)[
                        'nama'          => 'Rina Wati',
                        'id_tiket'      => '10029333-A',
                        'kategori'      => 'General',
                        'sudah_checkin' => false,
                        'url_etiket'    => '#',
                    ],
                ],
                'merchandises'       => [],
            ],
            (object)[
                'id'                 => 4,
                'kode_order'         => 'VEN-878055',
                'nama_event'         => 'International Jazz Series',
                'tanggal'            => '2024-04-20',
                'jam'                => '19:00',
                'gambar'             => null,
                'total'              => 2500000,
                'subtotal_tiket'     => 2500000,
                'subtotal_merch'     => 0,
                'pajak'              => 275000,
                'biaya_layanan'      => 25000,
                'status'             => 'paid',
                'metode_pembayaran'  => 'BCA Virtual Account',
                'tikets'             => [
                    (object)[
                        'nama'          => 'Doni Prasetyo',
                        'id_tiket'      => '10029334-A',
                        'kategori'      => 'VIP',
                        'sudah_checkin' => true,
                        'url_etiket'    => '#',
                    ],
                ],
                'merchandises'       => [],
            ],
        ];
    }

    /**
     * Daftar pesanan dengan filter status.
     */
    public function index(Request $request)
    {
        $status  = $request->query('status');
        $pesanan = collect($this->dummyData());

        if ($status && $status !== 'semua') {
            $pesanan = $pesanan->filter(fn($item) => $item->status === $status)->values();
        }

        return view('pesanan', compact('pesanan'));
    }

    /**
     * Detail satu pesanan.
     */
    public function show($id)
    {
        $pesanan = collect($this->dummyData())->firstWhere('id', (int) $id);

        if (!$pesanan) {
            abort(404);
        }

        return view('detailPesanan', compact('pesanan'));
    }

    /**
     * Unduh invoice (placeholder).
     */
    public function invoice($id)
    {
        // TODO: generate PDF invoice
        return back()->with('info', 'Fitur unduh invoice segera hadir.');
    }
}