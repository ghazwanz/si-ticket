<?php

use App\Http\Controllers\Admin\CancellationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\EventCatalogController;
use App\Http\Controllers\ScannerController;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $popularEvents = Event::with('category')
        ->where('status', 'published')
        ->orderBy('event_date')
        ->take(3)
        ->get();

    $eventCategories = EventCategory::orderBy('created_at', 'desc')->take(6)->get();

    return view('welcome', compact('popularEvents', 'eventCategories'));
})->name('landing');

Route::get('/events', [EventCatalogController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventCatalogController::class, 'show'])->name('events.show');

Route::get('/dashboard', function () {
    $role = request()->user()->role->value ?? request()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'organizer') {
        return redirect()->route('organizer.dashboard');
    }

    return redirect()->route('profile.index');
})->middleware(['auth', 'verified', 'role:admin,organizer,user'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Event Approval & Intelligence
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::put('events/{event}/status', [EventController::class, 'updateStatus'])->name('events.update-status');

    // Payout Management
    Route::get('payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('payouts/{payout}', [PayoutController::class, 'show'])->name('payouts.show');
    Route::post('payouts/initialize/{event}', [PayoutController::class, 'initialize'])->name('payouts.initialize');
    Route::put('payouts/{payout}/approve', [PayoutController::class, 'approve'])->name('payouts.approve');
    Route::put('payouts/{payout}/confirm', [PayoutController::class, 'confirm'])->name('payouts.confirm');

    // Cancellation Review Queue
    Route::get('cancellations', [CancellationController::class, 'index'])->name('cancellations.index');
    Route::put('cancellations/{cancellationRequest}/approve', [CancellationController::class, 'approve'])->name('cancellations.approve');
    Route::put('cancellations/{cancellationRequest}/reject', [CancellationController::class, 'reject'])->name('cancellations.reject');

    // Category Registry
    Route::get('event-categories', [EventCategoryController::class, 'index'])->name('event-categories.index');
    Route::post('event-categories', [EventCategoryController::class, 'store'])->name('event-categories.store');
    Route::put('event-categories/{event_category}', [EventCategoryController::class, 'update'])->name('event-categories.update');
    Route::delete('event-categories/{event_category}', [EventCategoryController::class, 'destroy'])->name('event-categories.destroy');

    // System Settings (Profile Settings)
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
});

// Organizer Routes
Route::middleware(['auth', 'verified', 'role:organizer'])->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('dashboard', [OrganizerDashboardController::class, 'index'])->name('dashboard');

    // Events CRUD
    Route::resource('events', App\Http\Controllers\Organizer\EventController::class);
    Route::post('events/{event}/cancel', [App\Http\Controllers\Organizer\EventController::class, 'cancel'])->name('events.cancel');
    Route::post('events/{event}/request-cancellation', [App\Http\Controllers\Organizer\EventController::class, 'requestCancellation'])->name('events.request-cancellation');

    Route::get('settings', function () {
        return view('organizer.settings');
    })->name('settings');

    // QR Scanner
    Route::get('scanner', [ScannerController::class, 'index'])->name('scanner.index');
});

// User Authenticated Routes
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // Checkout & Orders
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{id}/invoice', [PesananController::class, 'invoice'])->name('pesanan.invoice');
});

// Generic Authenticated Routes (Profiles for All Roles)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        Route::get('/orders/{orderId}', [ProfileController::class, 'orderDetail'])->name('order-detail');
        Route::get('/orders/{orderId}/tickets', [ProfileController::class, 'ticketsQr'])->name('tickets-qr');
    });
});

require __DIR__.'/auth.php';
