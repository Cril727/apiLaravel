<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = [
        'valorPago',
        'fechaPago',
        'id_prestamo'
    ];

    // protected $fillable = [
    //     'valor_pago',
    //     'pagado_el',
    //     'id_prestamo'
    // ];


    public function prestamo()
    {
        return $this->belongsTo(Prestamos::class, 'id_prestamo');
    }
}
