<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asociado extends Model
{
    protected $table = 'asociados';
    /**Anterior con apellido**/
    
    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'fecha_nacimiento',
        'genero'
    ];

    // protected $fillable = [
    //     'documento',
    //     'nombre',
    //     'email',
    //     'telefono',
    //     'fecha_nacimiento',
    //     'genero'
    // ];

    public function participaciones()
    {
        return $this->hasMany(participaciones::class, 'id_asociado');
    }

    public function prestamos()
    {
        return $this->hasMany(prestamos::class, 'id_asociado');
    }
}
