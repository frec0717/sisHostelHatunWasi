<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emisionderecibo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_emisionderecibo';

    protected $fillable = [
        'nombre_emisionderecibo',
        'estado_emisionderecibo'
    ];
}
