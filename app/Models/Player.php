<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'username',
        'type_identification',
        'identification_number',
        'email',
    ];

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_player', 'player_id', 'note_id')->with('author')->latest('notes.created_at');
    }
}
