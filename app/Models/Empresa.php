<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_empresa';
    protected $fillable = [
        'ruc_empresa',
        'razonsocial_empresa',
        'direccion_empresa',
        'celular_empresa',
        'telefono_empresa',
        'descripcion_empresa',
        'estado_empresa'
    ];
}
