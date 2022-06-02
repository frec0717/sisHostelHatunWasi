<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'tipocliente_id',
        'dniruc_cliente',
        'nombre_cliente',
        'direccion_cliente',
        'celular_cliente',
        'telefono_cliente',
        'correo_cliente',
        'estranjero_cliente',
        'estado_cliente'
    ];

    public function tipoclientes(): HasMany
    {
        return $this->hasMany(Tipocliente::class, 'id_tipocliente', 'tipocliente_id');
    }
}
