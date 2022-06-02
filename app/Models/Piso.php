<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_piso';

    protected $fillable = [
        'numero_piso',
        'estado_piso'
    ];
}
