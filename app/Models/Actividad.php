<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $fillable = [
        'nombre',
        'fecha',
        'monto_recaudo',
        'municipio'
    ];

    public function participaciones()
    {
        return $this->hasMany(participaciones::class, 'id_actividad');
    }
}
