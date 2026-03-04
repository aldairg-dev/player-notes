<?php

namespace App\Service;

use App\Contracts\PlayerRepositoryInterface;
use App\Models\Note;
use App\Models\Player;
use Illuminate\Support\Collection;

class PlayerNoteServices
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository,
    ) {}

    public function getAllPlayersWithNotes(): Collection
    {
        return $this->playerRepository->getAllWithNotes();
    }

    public function getPlayerHistory(int $playerId): Collection
    {
        return $this->playerRepository->getPlayerHistory($playerId);
    }

    public function addNoteToPlayer(int $playerId, int $authorId, string $content): Note
    {
        return $this->playerRepository->addNote($playerId, $authorId, $content);
    }

    public function createPlayer(array $data):Player
    {
        return $this->playerRepository->createPlayer($data);
    }
}
