<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Reservacion extends Model
{
    use HasFactory;
    protected $table = 'reservaciones'; 
    protected $primaryKey = 'id_reservacion';
    protected $fillable = [
        'user_id',
        'cliente_id',
        'formapago_id',
        'emisionderecibo_id',
        'fechae_reservacion',
        'fechas_reservacion',
        'npersona_reservacion',
        'codigopago_reservacion',
        'subt_reservacion',
        'descuento_reservacion',
        'igv_reservacion',
        'total_reservacion',
        'condicion_reservacion',
        'estado_reservacion'
    ];

    
    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }

    public function cliente(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id_cliente', 'cliente_id');
    } 

    public function formapago(): HasMany
    {
        return $this->hasMany(Formapago::class, 'id_formapago', 'formapago_id');
    }  

    public function emisionderecibo(): HasMany
    {
        return $this->hasMany(Emisionderecibo::class, 'id_emisionderecibo', 'emisionderecibo_id');
    }    
    public function reservacionhabitacion(): HasMany
    {
        
        return $this->hasMany(Reservacionhabitacion::class, 'reservacion_id', 'id_reservacion');
    }
    // public function reservacionhabitacion(): HasManyThrough
    // {
        
    //     return $this->hasManyThrough(Reservacionhabitacion::class,Habitacion::class,'reservacionhabitacion','habitaciones', 'id_habitacion', 'habitacion_id');
    // }
    
}
