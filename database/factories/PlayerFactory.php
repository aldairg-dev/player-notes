<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'type_identification' => fake()->randomElement(['CC', 'CE', 'PP']),
            'identification_number' => fake()->unique()->numerify('##########'),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
