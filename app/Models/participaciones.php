<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class participaciones extends Model
{
    protected $fillable = [
        'id_asociado',
        'id_actividad'
    ];

    public function asociado()
    {
        return $this->belongsTo(Asociado::class, 'id_asociado');
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'id_actividad');
    }
}
