<?php

namespace Tests\Feature;

use App\Livewire\PlayerNotes;
use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PlayerNotesValidationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Player $player;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'add player notes']);
        Permission::create(['name' => 'view player notes']);
        $role = Role::create(['name' => 'support-agent']);
        $role->givePermissionTo(['add player notes', 'view player notes']);

        $this->user = User::factory()->create();
        $this->user->assignRole('support-agent');

        $this->player = Player::factory()->create();
    }

    public function test_note_content_max_1000_characters_validation(): void
    {
        Livewire::actingAs($this->user)
            ->test(PlayerNotes::class)
            ->set('selectedPlayerId', $this->player->id)
            ->set('noteContent', str_repeat('a', 1001))
            ->call('confirmSaveNote')
            ->assertHasErrors(['noteContent' => 'max']);
    }

    public function test_note_content_required_validation(): void
    {
        Livewire::actingAs($this->user)
            ->test(PlayerNotes::class)
            ->set('selectedPlayerId', $this->player->id)
            ->set('noteContent', '')
            ->call('confirmSaveNote')
            ->assertHasErrors(['noteContent' => 'required']);
    }

    public function test_note_content_with_1000_characters_passes(): void
    {
        Livewire::actingAs($this->user)
            ->test(PlayerNotes::class)
            ->set('selectedPlayerId', $this->player->id)
            ->set('noteContent', str_repeat('a', 1000))
            ->call('confirmSaveNote')
            ->assertHasNoErrors('noteContent');
    }
}
