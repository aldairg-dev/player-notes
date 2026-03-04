<?php

namespace App\Livewire;

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
    public string $newPlayerFullName = '';
    public string $newPlayerUsername = '';
    public string $newPlayerEmail = '';
    public string $newPlayerTypeId = '';
    public string $newPlayerIdNumber = '';

    protected array $rules = [
        'noteContent'         => 'required|string|max:1000',
        'newPlayerFullName'   => 'required|string|max:200',
        'newPlayerUsername'   => 'required|string|max:50|unique:players,username',
        'newPlayerEmail'      => 'required|email|max:255|unique:players,email',
        'newPlayerTypeId'     => 'required|string|max:50',
        'newPlayerIdNumber'   => 'required|string|max:50|unique:players,identification_number',
    ];

    protected array $messages = [
        'noteContent.required'         => 'El contenido de la nota es obligatorio.',
        'noteContent.max'              => 'La nota no debe exceder los 1000 caracteres.',
        'newPlayerFullName.required'   => 'El nombre completo es obligatorio.',
        'newPlayerUsername.required'   => 'El nombre de usuario es obligatorio.',
        'newPlayerUsername.unique'     => 'Este nombre de usuario ya está en uso.',
        'newPlayerEmail.required'      => 'El correo electrónico es obligatorio.',
        'newPlayerEmail.email'         => 'Ingresa un correo electrónico válido.',
        'newPlayerEmail.unique'        => 'Este correo electrónico ya está registrado.',
        'newPlayerTypeId.required'     => 'El tipo de identificación es obligatorio.',
        'newPlayerIdNumber.required'   => 'El número de identificación es obligatorio.',
        'newPlayerIdNumber.unique'     => 'Este número de identificación ya está registrado.',
    ];


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
        $this->validateOnly('noteContent');

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
        $this->validateOnly('noteContent');
        $this->dispatch('swal:confirm-save-note');
    }

    #[On('confirmedSaveNote')]
    public function handleConfirmedSaveNote(PlayerNoteServices $service): void
    {
        $this->saveNote($service);
    }

    public function openAddPlayerModal(): void
    {
        $this->reset(['newPlayerFullName', 'newPlayerUsername', 'newPlayerEmail', 'newPlayerTypeId', 'newPlayerIdNumber']);
        $this->showAddPlayerModal = true;
    }

    public function closeAddPlayerModal(): void
    {
        $this->showAddPlayerModal = false;
        $this->reset(['newPlayerFullName', 'newPlayerUsername', 'newPlayerEmail', 'newPlayerTypeId', 'newPlayerIdNumber']);
        $this->resetValidation();
    }

    public function savePlayer(PlayerNoteServices $service): void
    {
        $this->validate([
            'newPlayerFullName' => $this->rules['newPlayerFullName'],
            'newPlayerUsername' => $this->rules['newPlayerUsername'],
            'newPlayerEmail' => $this->rules['newPlayerEmail'],
            'newPlayerTypeId' => $this->rules['newPlayerTypeId'],
            'newPlayerIdNumber' => $this->rules['newPlayerIdNumber'],
        ]);

        $service->createPlayer([
            'full_name' => $this->newPlayerFullName,
            'username' => $this->newPlayerUsername,
            'email' => $this->newPlayerEmail,
            'type_identification' => $this->newPlayerTypeId,
            'identification_number' => $this->newPlayerIdNumber,
        ]);

        $this->closeAddPlayerModal();
        $this->dispatch('swal:success', [
            'title' => '¡Jugador registrado!',
            'text'  => 'El nuevo jugador se agregó correctamente.',
        ]);
    }

    public function confirmSavePlayer(): void
    {
        $this->validate([
            'newPlayerFullName' => $this->rules['newPlayerFullName'],
            'newPlayerUsername' => $this->rules['newPlayerUsername'],
            'newPlayerEmail'    => $this->rules['newPlayerEmail'],
            'newPlayerTypeId'   => $this->rules['newPlayerTypeId'],
            'newPlayerIdNumber' => $this->rules['newPlayerIdNumber'],
        ]);
        $this->dispatch('swal:confirm-save-player');
    }

    #[On('confirmedSavePlayer')]
    public function handleConfirmedSavePlayer(PlayerNoteServices $service): void
    {
        $this->savePlayer($service);
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
