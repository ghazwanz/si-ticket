<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'paid', 'failed', 'cancelled']);

        return [
            'uuid' => (string) Str::uuid(),
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'status' => $status,
            'total_amount' => 0,
            'payment_type' => $this->faker->randomElement(['gopay', 'shopeepay', 'bank_transfer', 'credit_card']),
            'snap_retry_count' => 0,
            'failed_at' => $status === 'failed' ? now() : null,
            'cancelled_at' => $status === 'cancelled' ? now() : null,
            'midtrans_order_id' => 'JF-'.strtoupper(Str::random(10)),
            'midtrans_transaction_id' => Str::random(12),
            'snap_token' => Str::random(20),
            'stock_reserved_until' => now()->addMinutes(15),
            'paid_at' => $status === 'paid' ? now() : null,
        ];
    }
}
