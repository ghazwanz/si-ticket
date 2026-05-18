<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\MerchandiseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchandiseItemFactory extends Factory
{
    protected $model = MerchandiseItem::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'name' => $this->faker->randomElement(['Official T-Shirt', 'Limited Hoodie', 'Enamel Pin', 'Tote Bag', 'Poster Set']),
            'description' => $this->faker->paragraph(),
            'base_price' => $this->faker->randomElement([50000, 150000, 250000, 350000]),
            'image' => null,
            'is_available' => true,
        ];
    }
}
