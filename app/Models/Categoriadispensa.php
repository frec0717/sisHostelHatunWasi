<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriadispensa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_categoriadispensa';
    protected $fillable = [
        'nombre_categoriadispensa',
        'descripcion_categoriadispensa',
        'estado_categoriadispensa'
    ];
}
