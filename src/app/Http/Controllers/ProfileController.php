<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();

        if ($user->role === \App\Enums\UserRole::Admin) {
            return view('profile.admin', [
                'user' => $user,
            ]);
        }

        if ($user->role === \App\Enums\UserRole::Organizer) {
            $user->load('organizerProfile');
            $recentEvents = \App\Models\Event::where('organizer_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            return view('profile.eo', [
                'user' => $user,
                'recentEvents' => $recentEvents,
            ]);
        }

        // For Regular Users
        $recentOrders = Order::with('event')->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('profile.index', [
            'user' => $user,
            'recentOrders' => $recentOrders,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function orderDetail(Request $request, string $orderId): View
    {
        return view('profile.order-detail', [
            'orderId' => $orderId,
        ]);
    }

    /**
     * Display order tickets QR codes.
     */
    public function ticketsQr(Request $request, string $orderId): View
    {
        return view('profile.tickets-qr', [
            'orderId' => $orderId,
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
