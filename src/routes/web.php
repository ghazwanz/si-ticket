<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

$eventCatalog = [
    'joinfest-nights-world-tour' => [
        'slug' => 'joinfest-nights-world-tour',
        'title' => "JoinFest Night's World Tour",
        'location' => 'Jakarta Convention Center',
        'date' => '26 October 2026',
        'price' => 'Rp 150.000',
        'category' => 'Music Festival',
        'image' => 'img/EOBanner.png',
        'description' => 'Pertunjukan malam penuh energi dengan visual panggung spektakuler, line-up musisi populer, dan pengalaman festival yang tak terlupakan.',
    ],
    'joinfest-future-talks-summit' => [
        'slug' => 'joinfest-future-talks-summit',
        'title' => 'JoinFest Future Talks Summit',
        'location' => 'Bandung Creative Hub',
        'date' => '10 November 2026',
        'price' => 'Rp 75.000',
        'category' => 'Conference',
        'image' => 'img/Tiket.png',
        'description' => 'Summit inspiratif untuk kreator dan inovator, menghadirkan pembicara industri, networking session, serta workshop interaktif.',
    ],
    'grand-opening-joinfest-arena' => [
        'slug' => 'grand-opening-joinfest-arena',
        'title' => 'The Grand Opening JoinFest Arena',
        'location' => 'Surabaya Hall',
        'date' => '5 December 2026',
        'price' => 'Rp 425.000',
        'category' => 'Grand Show',
        'image' => 'img/KaosOfficial.png',
        'description' => 'Malam pembukaan arena JoinFest dengan konsep pertunjukan premium, tata cahaya imersif, dan special performance dari guest star.',
    ],
];

Route::get('/events', function () use ($eventCatalog) {
    return view('events.index', [
        'events' => array_values($eventCatalog),
    ]);
})->name('events.index');

Route::get('/events/{slug}', function (string $slug) use ($eventCatalog) {
    abort_unless(array_key_exists($slug, $eventCatalog), 404);

    return view('events.show', [
        'event' => $eventCatalog[$slug],
    ]);
})->name('events.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/{id}',  [PesananController::class, 'show'])->name('pesanan.show');

Route::get('/pesanan/{id}/invoice', [PesananController::class, 'invoice'])->name('pesanan.invoice');
// Route::get('/organizer/{id}',         [EventOrganizerController::class, 'show'])->name('organizer.show');
// Route::get('/organizer/{id}/hubungi', [EventOrganizerController::class, 'hubungi'])->name('organizer.hubungi');

// Route::middleware('auth')->group(function () {
//     Route::post('/organizer/{id}/ikuti', [EventOrganizerController::class, 'ikuti'])->name('organizer.ikuti');
// });

// Organizer Routes - Merchandise & Scanner
Route::middleware(['auth', 'verified'])->prefix('organizer')->name('organizer.')->group(function () {
    // Merchandise CRUD
    Route::get('merchandise', [MerchandiseController::class, 'index'])->name('merchandise.index');
    Route::get('merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
    Route::post('merchandise', [MerchandiseController::class, 'store'])->name('merchandise.store');
    Route::get('merchandise/{id}/edit', [MerchandiseController::class, 'edit'])->name('merchandise.edit');
    Route::put('merchandise/{id}', [MerchandiseController::class, 'update'])->name('merchandise.update');
    Route::delete('merchandise/{id}', [MerchandiseController::class, 'destroy'])->name('merchandise.destroy');
    
    // QR Scanner
    Route::get('scanner', [ScannerController::class, 'index'])->name('scanner.index');
});

// User Profile Routes
Route::middleware(['auth', 'verified'])->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('orders/{orderId}', [ProfileController::class, 'orderDetail'])->name('profile.order-detail');
    Route::get('orders/{orderId}/tickets', [ProfileController::class, 'ticketsQr'])->name('profile.tickets-qr');
});

require __DIR__.'/auth.php';
