<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    protected $fillable = [
        'valor',
        'tasaInteres',
        'numeroCuotas',
        'fechaPrestamo',
        'id_asociado'
    ];

    public function asociado()
    {
        return $this->belongsTo(Asociado::class, 'id_asociado');
    }

    public function pagos()
    {
        return $this->hasMany(Pagos::class, 'id_prestamo');
    }
}
