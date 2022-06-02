<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipohabitacion extends Model
{
    use HasFactory;
    
    protected $table = 'tipohabitaciones'; 
    protected $primaryKey = 'id_tipohabitacion';
    protected $fillable = [
        'nombre_tipohabitacion',
        'descripcion_tipohabitacion',
        'estado_tipohabitacion'
    ];

}
