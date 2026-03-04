<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Support Agent',
            'email' => 'agent@example.com',
        ]);

        $players = Player::all();

        $players->each(function (Player $player) use ($user): void {
            $notes = Note::factory()->count(3)->create([
                'author_id' => $user->id,
            ]);

            $player->notes()->attach($notes->pluck('id'));
        });
    }
}
