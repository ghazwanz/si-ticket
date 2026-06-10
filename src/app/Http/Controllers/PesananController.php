<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Daftar pesanan dengan filter status.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Order::with('event')->where('user_id', Auth::id());

        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }

        $pesanan = $query->latest()->paginate(10);

        return view('pesanan', compact('pesanan'));
    }

    /**
     * Detail satu pesanan.
     */
    public function show($id)
    {
        $pesanan = Order::with(['event', 'tickets.ticketCategory', 'merchandise.merchandiseVariant.item'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

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
