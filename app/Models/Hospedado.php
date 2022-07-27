<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospedado extends Model
{
    use HasFactory;
    protected $table = 'hospedajes';
    protected $primaryKey = 'id_hospedaje';
    protected $fillable = [
        'user_id',
        'cliente_id',
        'formapago_id',
        'emisionderecibo_id',
        'fechae_hospedaje',
        'fechas_hospedaje',
        'npersona_hospedaje',
        'codigopago_hospedaje',
        'subt_hospedaje',
        'descuento_hospedaje',
        'igv_hospedaje',
        'total_hospedaje',
        'condicion_hospedaje',
        'porefe_hospedaje',
        'estado_hospedaje'
    ];
}
