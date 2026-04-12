<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman checkout.
     */
    public function index()
    {
        // Contoh data pesanan — sesuaikan dengan logika cart/session Anda
        $tikets = collect([
            (object)[
                'nama'  => 'Festival (Standing)',
                'qty'   => 1,
                'harga' => 750000,
            ],
        ]);

        $merchandises = collect([
            (object)[
                'nama'   => 'Kaos Official',
                'qty'    => 1,
                'harga'  => 249000,
                'varian' => 'Size L',
            ],
            (object)[
                'nama'   => 'Tote Bag',
                'qty'    => 1,
                'harga'  => 129000,
                'varian' => 'Black',
            ],
        ]);

        $subtotal      = $tikets->sum(fn($t) => $t->harga * $t->qty)
                       + $merchandises->sum(fn($m) => $m->harga * $m->qty);
        $biaya_layanan = 15000;
        $pajak         = (int) round($subtotal * 0.1);
        $total         = $subtotal + $biaya_layanan + $pajak;

        return view('checkout', compact(
            'tikets',
            'merchandises',
            'subtotal',
            'biaya_layanan',
            'pajak',
            'total'
        ));
    }

    /**
     * Proses data checkout.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'no_telepon'   => ['required', 'string', 'regex:/^[0-9\+\-\s]{8,20}$/'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'      => 'Nama minimal 3 karakter.',
            'email.required'        => 'Alamat email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'no_telepon.required'   => 'Nomor telepon wajib diisi.',
            'no_telepon.regex'      => 'Format nomor telepon tidak valid.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // TODO: Simpan order ke database, integrasikan payment gateway, dsb.
        // Contoh:
        // $order = Order::create([
        //     'nama_lengkap' => $request->nama_lengkap,
        //     'email'        => $request->email,
        //     'no_telepon'   => $request->no_telepon,
        //     'total'        => $request->total,
        //     'status'       => 'pending',
        // ]);

        return back()->with('success', 'Pesanan berhasil diproses! Kami akan mengirimkan konfirmasi ke email Anda.');
    }
}