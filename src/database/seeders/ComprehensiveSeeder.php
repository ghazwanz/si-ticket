<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\CancellationRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\MerchandiseItem;
use App\Models\MerchandiseVariant;
use App\Models\Order;
use App\Models\OrderMerchandise;
use App\Models\OrderTicket;
use App\Models\Payout;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ComprehensiveSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure Categories exist
        $this->call(EventCategorySeeder::class);
        $categories = EventCategory::all();

        // 2. Create Admin
        User::firstOrCreate(
            ['email' => 'admin@joinfest.com'],
            [
                'name' => 'JoinFest Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::Admin,
                'is_active' => true,
            ]
        );

        // 3. Create regular customers
        $customers = User::factory()->count(30)->create(['role' => UserRole::User]);

        // 4. Create Organizers and their ecosystem
        User::factory()->count(5)->create(['role' => UserRole::Organizer])->each(function ($organizer) use ($categories, $customers) {

            // Create Events for each Organizer
            $statuses = ['published', 'completed', 'awaiting_approval', 'awaiting_cancellation', 'cancelled'];

            foreach ($statuses as $status) {
                $event = Event::factory()->create([
                    'organizer_id' => $organizer->id,
                    'category_id' => $categories->random()->id,
                    'status' => $status,
                ]);

                // Create Ticket Categories
                $ticketCategories = TicketCategory::factory()->count(3)->create([
                    'event_id' => $event->id,
                ]);

                // Create Merchandise
                MerchandiseItem::factory()->count(2)->create([
                    'event_id' => $event->id,
                ])->each(function ($item) {
                    // Variants for each item
                    $sizes = ['S', 'M', 'L', 'XL'];
                    foreach ($sizes as $size) {
                        MerchandiseVariant::factory()->create([
                            'merchandise_item_id' => $item->id,
                            'variant_group' => 'Size',
                            'variant_value' => $size,
                        ]);
                    }
                });

                // Create Orders if Event is published, completed, awaiting cancellation, or cancelled
                if (in_array($event->status, ['published', 'completed', 'awaiting_cancellation', 'cancelled'])) {
                    $orderCount = $event->status === 'completed' ? 12 : 6;

                    for ($i = 0; $i < $orderCount; $i++) {
                        $order = Order::factory()->create([
                            'user_id' => $customers->random()->id,
                            'event_id' => $event->id,
                            'status' => 'paid',
                            'paid_at' => now()->subDays(rand(1, 10)),
                        ]);

                        // Add tickets
                        $cat = $ticketCategories->random();
                        OrderTicket::factory()->count(rand(1, 2))->create([
                            'order_id' => $order->id,
                            'ticket_category_id' => $cat->id,
                            'unit_price' => $cat->price,
                        ]);

                        // Add merch to some orders
                        if (rand(1, 10) > 7) {
                            $variant = MerchandiseVariant::whereHas('item', function ($q) use ($event) {
                                $q->where('event_id', $event->id);
                            })->inRandomOrder()->first();

                            if ($variant) {
                                OrderMerchandise::factory()->create([
                                    'order_id' => $order->id,
                                    'merchandise_variant_id' => $variant->id,
                                    'unit_price' => $variant->item->base_price + $variant->price_adjustment,
                                    'quantity' => rand(1, 2),
                                ]);
                            }
                        }

                        // Update order total
                        $order->update([
                            'total_amount' => $order->tickets->sum('unit_price') + $order->merchandise->sum(fn ($m) => $m->unit_price * $m->quantity),
                        ]);
                    }
                }

                // Seed Cancellation Request and Payout depending on status
                if ($event->status === 'awaiting_cancellation') {
                    CancellationRequest::factory()->create([
                        'event_id' => $event->id,
                        'requested_by' => $organizer->id,
                        'status' => 'pending',
                        'reason' => 'Saya harus membatalkan acara ini karena alasan darurat medis dan kendala logistik di lapangan.',
                    ]);

                    $revenue = Order::where('event_id', $event->id)->where('status', 'paid')->sum('total_amount');
                    $fee = $revenue * 0.10;

                    Payout::factory()->create([
                        'event_id' => $event->id,
                        'organizer_id' => $organizer->id,
                        'gross_amount' => $revenue,
                        'platform_fee' => $fee,
                        'net_amount' => $revenue - $fee,
                        'status' => 'pending',
                        'fee_percentage' => 10.00,
                    ]);
                } elseif ($event->status === 'cancelled') {
                    $admin = User::where('role', UserRole::Admin)->first();
                    CancellationRequest::factory()->create([
                        'event_id' => $event->id,
                        'requested_by' => $organizer->id,
                        'status' => 'approved',
                        'reason' => 'Masalah teknis yang tidak dapat diselesaikan dengan vendor utama.',
                        'reviewed_by' => $admin?->id,
                        'reviewed_at' => now(),
                    ]);

                    $revenue = Order::where('event_id', $event->id)->where('status', 'paid')->sum('total_amount');
                    $fee = $revenue * 0.10;

                    Payout::factory()->create([
                        'event_id' => $event->id,
                        'organizer_id' => $organizer->id,
                        'gross_amount' => $revenue,
                        'platform_fee' => $fee,
                        'net_amount' => $revenue - $fee,
                        'status' => 'voided',
                        'fee_percentage' => 10.00,
                    ]);
                } elseif ($event->status === 'completed') {
                    $revenue = Order::where('event_id', $event->id)->where('status', 'paid')->sum('total_amount');
                    $fee = $revenue * 0.10;

                    Payout::factory()->create([
                        'event_id' => $event->id,
                        'organizer_id' => $organizer->id,
                        'gross_amount' => $revenue,
                        'platform_fee' => $fee,
                        'net_amount' => $revenue - $fee,
                        'status' => 'completed',
                        'fee_percentage' => 10.00,
                    ]);
                } elseif ($event->status === 'published' && rand(1, 10) > 8) {
                    $admin = User::where('role', UserRole::Admin)->first();
                    CancellationRequest::factory()->create([
                        'event_id' => $event->id,
                        'requested_by' => $organizer->id,
                        'status' => 'rejected',
                        'reason' => 'Pengen batalin aja sepi peminat.',
                        'reviewed_by' => $admin?->id,
                        'rejection_reason' => 'Alasan pembatalan tidak memenuhi syarat minimum (tidak ada kondisi force majeure atau darurat).',
                        'reviewed_at' => now(),
                    ]);
                }
            }
        });
    }
}
