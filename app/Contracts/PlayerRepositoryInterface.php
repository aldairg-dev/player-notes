<?php

namespace App\Contracts;

use App\Models\Note;
use App\Models\Player;
use Illuminate\Support\Collection;

interface PlayerRepositoryInterface
{
    public function getAllWithNotes(): Collection;

    public function getPlayerHistory(int $playerId): Collection;

    public function addNote(int $playerId, int $authorId, string $content): Note;

    public function createPlayer(array $data): Player;

    public function updatePlayer(int $playerId, array $data): Player;
}
