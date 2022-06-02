<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipocliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tipocliente';

    protected $fillable = [
        'nombre_tipocliente',
        'estado_tipocliente'
    ];
}
