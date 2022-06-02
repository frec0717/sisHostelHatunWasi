<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tour';

    protected $fillable = [
        'empresa_id',
        'fechai_tour',
        'fechaf_tour',
        'nombre_tour',
        'descripcion_tour',
        'estado_tour'
    ];

    public function empresas(): HasMany
    {
        return $this->hasMany(Empresa::class, 'id_empresa', 'empresa_id');
    }
}
