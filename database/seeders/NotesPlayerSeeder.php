<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Player;
use Illuminate\Database\Seeder;

class NotesPlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = Player::all();
        $notes = Note::all();

        $players->each(function (Player $player) use ($notes): void {
            $player->notes()->syncWithoutDetaching(
                $notes->random(min(2, $notes->count()))->pluck('id')
            );
        });
    }
}
