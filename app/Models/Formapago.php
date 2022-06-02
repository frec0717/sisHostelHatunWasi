<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formapago extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_formapago';

    protected $fillable = [
        'nombre_formapago',
        'estado_formapago'
    ];
}
