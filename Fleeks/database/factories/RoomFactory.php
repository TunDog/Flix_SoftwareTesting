<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'capacity' => fake()->numberBetween(1, 20),
            'price_per_hour' => fake()->numberBetween(100, 2000),
            'image_path' => null,
            'is_active' => true,
        ];
    }
}

