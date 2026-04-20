<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Users
        $organizer = User::firstOrCreate(
            ['email' => 'eo@bintang.com'],
            [
                'id' => Str::uuid(),
                'name' => 'Bintang Kreasindo',
                'password' => Hash::make('password'),
                'role' => UserRole::Organizer,
                'is_active' => true,
            ]
        );

        DB::table('organizer_profiles')->insertOrIgnore([
            'id' => Str::uuid(),
            'user_id' => $organizer->id,
            'organization_name' => 'Bintang Kreasindo EO',
            'phone' => '081234567890',
            'bank_name' => 'BCA',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'Bintang Kreasindo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::firstOrCreate(
            ['email' => 'user@demo.com'],
            [
                'id' => Str::uuid(),
                'name' => 'Reguler User Demo',
                'password' => Hash::make('password'),
                'role' => UserRole::User,
                'is_active' => true,
            ]
        );

        // 2. Create Event Categories
        $categories = ['Konser', 'Seminar', 'Olahraga', 'Teater', 'Seni', 'Film'];
        $categoryIds = [];
        foreach ($categories as $cat) {
            $catId = Str::uuid();
            DB::table('event_categories')->updateOrInsert(
                ['slug' => Str::slug($cat)],
                [
                    'id' => $catId,
                    'name' => $cat,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $categoryIds[] = DB::table('event_categories')->where('name', $cat)->value('id');
        }

        // 3. Create Events
        $eventId = Str::uuid();
        DB::table('events')->updateOrInsert(
            ['slug' => Str::slug('Neon Nights World Tour 2026')],
            [
                'id' => $eventId,
                'organizer_id' => $organizer->id,
                'category_id' => $categoryIds[0], // Konser
                'name' => 'Neon Nights World Tour 2026',
                'description' => '<p>Konser musik terbesar tahun ini, menghadirkan musisi kelas dunia dengan panggung megah.</p>',
                'banner_image' => 'eobanner.png',
                'venue_name' => 'Sleman City Hall',
                'address' => 'Jl. Magelang Km 9,6',
                'city' => 'Yogyakarta',
                'event_date' => '2026-12-04',
                'start_time' => '19:00:00',
                'end_time' => '23:00:00',
                'status' => 'published',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $eventId = DB::table('events')->where('slug', Str::slug('Neon Nights World Tour 2026'))->value('id');

        // 4. Create Ticket Categories
        $ticketId1 = Str::uuid();
        $ticketId2 = Str::uuid();
        DB::table('ticket_categories')->insert([
            [
                'id' => $ticketId1,
                'event_id' => $eventId,
                'name' => 'Festival A (Standing)',
                'description' => 'Area berdiri paling dekat dengan panggung.',
                'price' => 750000,
                'quota' => 2000,
                'sold_count' => 150,
                'sale_start_at' => now()->subDays(5),
                'sale_end_at' => now()->addMonths(6),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => $ticketId2,
                'event_id' => $eventId,
                'name' => 'VIP (Seating)',
                'description' => 'Area duduk VIP dengan akses jalur khusus.',
                'price' => 1500000,
                'quota' => 500,
                'sold_count' => 50,
                'sale_start_at' => now()->subDays(5),
                'sale_end_at' => now()->addMonths(6),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Create Merchandise Items & Variants
        $merchId = Str::uuid();
        DB::table('merchandise_items')->insert([
            'id' => $merchId,
            'event_id' => $eventId,
            'name' => 'Official T-Shirt Neon Nights',
            'description' => 'Kaos event resmi edisi terbatas.',
            'image' => 'KaosOfficial.png',
            'base_price' => 250000,
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $variantId = Str::uuid();
        DB::table('merchandise_variants')->insert([
            'id' => $variantId,
            'merchandise_item_id' => $merchId,
            'variant_group' => 'Size ' . Str::random(5),
            'variant_value' => 'L',
            'stock' => 100,
            'price_adjustment' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 6. Create Demo Order (Paid)
        $orderId = Str::uuid();
        DB::table('orders')->insert([
            'id' => $orderId,
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'event_id' => $eventId,
            'status' => 'paid',
            'total_amount' => 1000000, // 750k tiket + 250k merch
            'midtrans_order_id' => 'ORDER-' . Str::random(8),
            'midtrans_transaction_id' => Str::uuid(),
            'paid_at' => now()->subDays(1),
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1),
        ]);

        // 7. Create Order Tickets
        DB::table('order_tickets')->insert([
            'id' => Str::uuid(),
            'order_id' => $orderId,
            'ticket_category_id' => $ticketId1,
            'qr_token' => Str::uuid(),
            'holder_name' => $user->name,
            'unit_price' => 750000,
            'is_checked_in' => false,
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1),
        ]);

        // 8. Create Order Merchandise
        DB::table('order_merchandise')->insert([
            'id' => Str::uuid(),
            'order_id' => $orderId,
            'merchandise_variant_id' => $variantId,
            'quantity' => 1,
            'unit_price' => 250000,
            'is_picked_up' => false,
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1),
        ]);
    }
}
