<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{
    public function run(): void
    {
        Player::factory()->count(10)->create();
    }
}
