<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Reservacionhabitacion extends Model
{
    use HasFactory;
    protected $table = 'reservacionhabitaciones'; 
    protected $primaryKey = 'id_reservacionhabitacion';
    
    protected $fillable = [
        'reservacion_id',
        'habitacion_id ',
        'precio_reservacionhabitacion ',
        'recargo_reservacionhabitacion ',
        'total_reservacionhabitacion ',
        'estado_reservacionhabitacion'
    ];

    public function reservacion(): HasMany
    {
        return $this->hasMany(Reservacion::class, 'id_reservacion', 'reservacion_id');
    }
    public function habitacion(): HasMany
    {
        return $this->hasMany(Habitacion::class, 'id_habitacion', 'habitacion_id');
    }
   
   

}
