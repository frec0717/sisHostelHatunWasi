<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_ingreso';

    protected $fillable = [
        'id_user',
        'fecha_ingreso',
        'nombre_ingreso',
        'descripcion_ingreso',
        'nrecibo_ingreso',
        'monto_ingreso',
        'estado_ingreso'
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','id_user');
    }   
}
