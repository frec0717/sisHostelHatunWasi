<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitacion extends Model
{
    use HasFactory;
    protected $table = 'habitaciones'; 
    protected $primaryKey = 'id_habitacion';
    protected $fillable = [
        'tipohabitacion_id',
        'piso_id',
        'numero_habitacion',
        'descripcion_habitacion',
        'estado_habitacion'
    ];

    public function tipoHabitacion(): HasMany
    {
        return $this->hasMany(Tipohabitacion::class, 'id_tipohabitacion', 'tipohabitacion_id');
    }    
    public function piso(): HasMany
    {
        return $this->hasMany(Piso::class, 'id_piso', 'piso_id');
    }   

    public function reservacion()    
    {
        return $this->belongsTo(Reservacionhabitacion::class);
    }    

}
