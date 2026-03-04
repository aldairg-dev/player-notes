<?php

namespace App\Repositories;

use App\Contracts\PlayerRepositoryInterface;
use App\Models\Note;
use App\Models\Player;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function getAllWithNotes(): Collection
    {
        return Player::with('notes.author')->get();
    }

    public function getPlayerHistory(int $playerId): Collection
    {
        return Player::findOrFail($playerId)
            ->notes()
            ->with('author')
            ->latest()
            ->get();
    }

    public function addNote(int $playerId, int $authorId, string $content): Note
    {
        /** @var Note $note */
        $note = null;

        DB::transaction(function () use (&$note, $playerId, $authorId, $content): void {
            $note = Note::create([
                'content' => $content,
                'author_id' => $authorId,
            ]);

            $note->players()->attach($playerId);
        });

        return $note;
    }

    public function createPlayer(array $data): Player
    {
        return Player::create($data);
    }
}
