<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utensilio extends Model
{
    use HasFactory;

    protected $table = "utensilios";
    protected $primaryKey = 'id_utensilio';

    protected $fillable = [
        'tipoutensilio_id',
        'estado_tipoutensilio',
        'nombre_utensilio',
        'cantidad_utensilio',
        'descripcion_utensilio',
        'estado_utensilio',
    ];

    // public function tipoutensilios()
    // {
    //     // return $this->belongsToMany(Tipoutensilio::class,'tipoutensilios','tipoutensilio_id','id_tipoutensilio')->withTimestamps();
    //     return $this->belongsToMany(Tipoutensilio::class,'tipoutensilios','tipoutensilio_id','id_tipoutensilio');
    // }

    public function tipoutensilios(): HasMany
    {
        return $this->hasMany(Tipoutensilio::class, 'id_tipoutensilio', 'tipoutensilio_id');
    }

}
