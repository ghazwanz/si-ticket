<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Payout;
use App\Services\PayoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvalidArgumentException;

class PayoutController extends Controller
{
    public function __construct(
        private readonly PayoutService $payoutService
    ) {}

    public function index(Request $request): View
    {
        $status = $request->query('status');
        $payouts = $this->payoutService->getPaginatedPayouts($request->all());

        return view('admin.payouts.index', compact('payouts', 'status'));
    }

    public function show(Payout $payout): View
    {
        $payout->load('event', 'organizer.organizerProfile', 'reviewer', 'disburser');

        return view('admin.payouts.show', compact('payout'));
    }

    public function initialize(Event $event): RedirectResponse
    {
        try {
            $this->payoutService->initializePayout($event);

            return back()->with('success', 'Payout initialized successfully.');
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function approve(Payout $payout, Request $request): RedirectResponse
    {
        try {
            $this->payoutService->approvePayout($payout, $request->user());

            return back()->with('success', 'Payout approved for disbursement.');
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function confirm(Payout $payout, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'midtrans_reference' => ['required', 'string', 'max:255'],
        ]);

        try {
            $this->payoutService->confirmPayout($payout, $request->user(), $validated['midtrans_reference']);

            return back()->with('success', 'Payout confirmed as completed.');
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
