<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\TicketCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketCategoryFactory extends Factory
{
    protected $model = TicketCategory::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'name' => $this->faker->randomElement(['VIP', 'Early Bird', 'General Admission', 'Presale 1', 'Presale 2']),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomElement([150000, 250000, 500000, 750000, 1000000]),
            'quota' => $this->faker->numberBetween(50, 500),
            'sold_count' => 0,
            'sale_start_at' => now()->subDays(5),
            'sale_end_at' => now()->addMonths(1),
            'is_active' => true,
            'max_per_user' => 4,
        ];
    }
}
