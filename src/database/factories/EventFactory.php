<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $name = $this->faker->sentence(3);

        return [
            'organizer_id' => User::factory(),
            'category_id' => EventCategory::factory(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::random(5),
            'description' => $this->faker->paragraphs(3, true),
            'venue_name' => $this->faker->company().' Arena',
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'event_date' => $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'start_time' => '19:00:00',
            'end_time' => '22:00:00',
            'status' => $this->faker->randomElement(['draft', 'awaiting_approval', 'published', 'completed']),
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}
