<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    // protected $table = 'egreso';

    protected $primaryKey = 'id_egreso';
    // protected $with = 'user';

    protected $fillable = [
        'id_user',
        'fecha_egreso',
        'nombre_egreso',
        'descripcion_egreso',
        'nrecibo_egreso',
        'monto_egreso',
        'estado_egreso'
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','id_user');
    }    
    
}
