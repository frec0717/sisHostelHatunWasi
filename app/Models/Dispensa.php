<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispensa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dispensa';

    protected $fillable = [
        'categoriadispensa_id',
        'nombre_dispensa',
        'cantidad_dispensa',
        'precioc_dispensa',
        'preciov_dispensa',
        'fechav_dispensa',
        'descripcion_dispensa',
        'estado_dispensa'
    ];

    public function categoriadispensas(): HasMany
    {
        return $this->hasMany(Categoriadispensa::class, 'id_categoriadispensa', 'categoriadispensa_id');
    }

}
