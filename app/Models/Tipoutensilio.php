<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipoutensilio extends Model
{
    use HasFactory;
    protected $table = "tipoutensilios";
    protected $primaryKey = 'id_tipoutensilio';

    protected $fillable = [
        'nombre_tipoutensilio',
        'estado_tipoutensilio'
    ];

    
}
