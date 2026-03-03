<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Players extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'full_name',
        'username',
        'type_identification',
        'identification_number',
        'email',
    ];
}

