<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class NotesPlayer extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'player_id',
        'note_id',
    ];
}
