<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayoutFactory extends Factory
{
    protected $model = Payout::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'processing', 'completed', 'failed']);

        return [
            'event_id' => Event::factory(),
            'organizer_id' => User::factory(),
            'gross_amount' => $this->faker->numberBetween(5000000, 50000000),
            'fee_percentage' => 10.00,
            'platform_fee' => 0, // Calculated
            'net_amount' => 0, // Calculated
            'status' => $status,
            'payout_bank_name' => $this->faker->randomElement(['BCA', 'Mandiri', 'BNI', 'BRI']),
            'payout_account_holder' => $this->faker->name(),
            'payout_account_number' => $this->faker->bankAccountNumber(),
            'missing_bank_details' => false,
            'reviewed_by' => $status !== 'pending' ? User::factory() : null,
            'reviewed_at' => $status !== 'pending' ? now() : null,
            'disbursed_by' => $status === 'completed' ? User::factory() : null,
            'disbursed_at' => $status === 'completed' ? now() : null,
            'midtrans_reference' => $status === 'completed' ? 'REF-'.rand(1000, 9999) : null,
        ];
    }
}
