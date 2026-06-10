<?php

namespace Database\Factories;

use App\Enums\EventStatus;
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
            'organizer_id' => User::factory()->organizer(),
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
            'status' => $this->faker->randomElement(EventStatus::cases()),
            'is_featured' => $this->faker->boolean(20),
        ];
    }

    /**
     * Set event status to draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EventStatus::Draft,
        ]);
    }

    /**
     * Set event status to awaiting approval.
     */
    public function awaitingApproval(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EventStatus::AwaitingApproval,
        ]);
    }

    /**
     * Set event status to published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EventStatus::Published,
        ]);
    }

    /**
     * Set event status to awaiting cancellation.
     */
    public function awaitingCancellation(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EventStatus::AwaitingCancellation,
        ]);
    }

    /**
     * Set event status to completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EventStatus::Completed,
        ]);
    }

    /**
     * Set event status to cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => EventStatus::Cancelled,
        ]);
    }

    /**
     * Set event as featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
