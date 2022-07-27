<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospedadohabitacion extends Model
{
    use HasFactory;
    protected $table = 'hospedajehabitaciones';
    protected $primaryKey = 'id_hospedajehabitacion';
    protected $fillable = [
        'hospedaje_id',
        'habitacion_id',
        'precio_hospedajehabitacion',
        'recargo_hospedajehabitacion',
        'total_hospedajehabitacion',
        'porefe_hospedajehabitacion',
        'estado_hospedajehabitacion'
    ];
}
