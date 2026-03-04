<?php

namespace App\Livewire;

use App\Http\Requests\RuleCreatePlayer;
use App\Http\Requests\RulePlayerNotes;
use App\Models\Player;
use App\Service\PlayerNoteServices;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class PlayerNotes extends Component
{
    public ?int $selectedPlayerId = null;
    public bool $showModal = false;

    public bool $showAddNoteModal = false;
    public string $noteContent = '';

    public bool $showAddPlayerModal = false;
    public string $playerFullName = '';
    public string $playerUsername = '';
    public string $playerEmail = '';
    public string $playerTypeId = '';
    public string $playerIdNumber = '';
    public bool $isEditMode = false;

    public function openNotes(int $playerId): void
    {
        $this->selectedPlayerId = $playerId;
        $this->showModal = true;
    }

    public function closeNotes(): void
    {
        $this->showModal = false;
        $this->selectedPlayerId = null;
        $this->resetValidation();
    }

    public function openAddNote(int $playerId): void
    {
        $this->selectedPlayerId = $playerId;
        $this->noteContent = '';
        $this->showAddNoteModal = true;
    }

    public function closeAddNote(): void
    {
        $this->showAddNoteModal = false;
        $this->selectedPlayerId = null;
        $this->noteContent = '';
        $this->resetValidation();
    }

    public function saveNote(PlayerNoteServices $service): void
    {
        $noteRequest = new RulePlayerNotes();
        $this->validateOnly('noteContent', $noteRequest->rules(), $noteRequest->messages());

        $service->addNoteToPlayer(
            $this->selectedPlayerId,
            auth()->id(),
            $this->noteContent,
        );

        $this->closeAddNote();
        $this->dispatch('swal:success', [
            'title' => '¡Comentario guardado!',
            'text'  => 'El comentario se agregó correctamente.',
        ]);
    }

    public function confirmSaveNote(): void
    {
        $noteRequest = new RulePlayerNotes();
        $this->validateOnly('noteContent', $noteRequest->rules(), $noteRequest->messages());
        $this->dispatch('swal:confirm-save-note');
    }

    #[On('confirmedSaveNote')]
    public function handleConfirmedSaveNote(PlayerNoteServices $service): void
    {
        $this->saveNote($service);
    }

    public function openAddPlayerModal(bool $reset, Player $player): void
    {
        $this->reset(['playerFullName', 'playerUsername', 'playerEmail', 'playerTypeId', 'playerIdNumber']);
        $this->showAddPlayerModal = true;
        if ($reset) {
            $this->isEditMode = true;
            $this->openEditPlayerModal($player);
        } else {
            $this->isEditMode = false;
        }
    }

    public function openEditPlayerModal(Player $player): void
    {
        if ($player) {
            $this->playerFullName = $player->full_name;
            $this->playerUsername = $player->username;
            $this->playerEmail = $player->email;
            $this->playerTypeId = $player->type_identification;
            $this->playerIdNumber = $player->identification_number;
        }
    }

    public function closeAddPlayerModal(): void
    {
        $this->showAddPlayerModal = false;
        $this->reset(['playerFullName', 'playerUsername', 'playerEmail', 'playerTypeId', 'playerIdNumber']);
        $this->resetValidation();
    }

    public function savePlayer(PlayerNoteServices $service): void
    {
        $playerRequest = new RuleCreatePlayer();
        $this->validate($playerRequest->rules(), $playerRequest->messages());

        $service->createPlayer([
            'full_name' => $this->playerFullName,
            'username' => $this->playerUsername,
            'email' => $this->playerEmail,
            'type_identification' => $this->playerTypeId,
            'identification_number' => $this->playerIdNumber,
        ]);

        $this->closeAddPlayerModal();
        $this->dispatch('swal:success', [
            'title' => '¡Jugador registrado!',
            'text'  => 'El nuevo jugador se agregó correctamente.',
        ]);
    }

    public function confirmSavePlayer(): void
    {
        $playerRequest = new RuleCreatePlayer();
        $this->validate($playerRequest->rules(), $playerRequest->messages());
        $this->dispatch('swal:confirm-save-player');
    }

    #[On('confirmedSavePlayer')]
    public function handleConfirmedSavePlayer(PlayerNoteServices $service): void
    {
        $this->savePlayer($service);
    }


    public function updatePlayer(int $playerId, PlayerNoteServices $service): void
    {
        $playerRequest = new RuleCreatePlayer();
        $this->validate($playerRequest->rules(), $playerRequest->messages());

        $service->updatePlayer($playerId, [
            'full_name' => $this->playerFullName,
            'username' => $this->playerUsername,
            'email' => $this->playerEmail,
            'type_identification' => $this->playerTypeId,
            'identification_number' => $this->playerIdNumber,
        ]);

        $this->closeAddPlayerModal();
        $this->dispatch('swal:success', [
            'title' => '¡Jugador actualizado!',
            'text'  => 'Los datos del jugador se actualizaron correctamente.',
        ]);
    }


    public function render(PlayerNoteServices $service): View
    {
        /** @var Collection $history */
        $history = $this->selectedPlayerId
            ? $service->getPlayerHistory($this->selectedPlayerId)
            : collect();

        return view('livewire.player-notes', [
            'players' => $service->getAllPlayersWithNotes(),
            'history' => $history,
        ]);
    }
}
