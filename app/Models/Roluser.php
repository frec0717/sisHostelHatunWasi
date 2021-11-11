<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roluser extends Model
{
    use HasFactory;
    protected $table = 'role_user';//nombre de tabla

    protected $fillable = [//atributos
        'user_id',
        'role_id'
    ];
}
