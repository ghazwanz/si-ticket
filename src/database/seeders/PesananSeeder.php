<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@joinfest.com')->first();
        $eventId = DB::table('events')->where('slug', Str::slug('Neon Nights World Tour 2026'))->value('id');
        $ticketId = DB::table('ticket_categories')->where('event_id', $eventId)->first()->id;
        $variantId = DB::table('merchandise_variants')->first()->id;

        $orderId = Str::uuid()->toString();
        DB::table('orders')->insert([
            'id' => $orderId,
            'uuid' => Str::uuid()->toString(),
            'user_id' => $user->id,
            'event_id' => $eventId,
            'status' => 'paid',
            'total_amount' => 1000000, // 750k tiket + 250k merch
            'payment_type' => 'credit_card',
            'snap_retry_count' => 0,
            'midtrans_order_id' => 'ORDER-'.Str::random(8),
            'midtrans_transaction_id' => Str::uuid()->toString(),
            'paid_at' => now()->subDays(1),
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1),
        ]);

        DB::table('order_tickets')->insert([
            'id' => Str::uuid()->toString(),
            'order_id' => $orderId,
            'ticket_category_id' => $ticketId,
            'qr_token' => Str::uuid()->toString(),
            'holder_name' => $user->name,
            'unit_price' => 750000,
            'is_checked_in' => false,
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1),
        ]);

        DB::table('order_merchandise')->insert([
            'id' => Str::uuid()->toString(),
            'order_id' => $orderId,
            'merchandise_variant_id' => $variantId,
            'merch_token' => Str::uuid()->toString(),
            'quantity' => 1,
            'unit_price' => 250000,
            'is_picked_up' => false,
            'created_at' => now()->subDays(1),
            'updated_at' => now()->subDays(1),
        ]);
    }
}
