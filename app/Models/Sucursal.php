<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sucursales';

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'sucursal_id');
    }

    public function rutasOrigen()
    {
        return $this->hasMany(Ruta::class, 'origen_id');
    }

    public function rutasDestino()
    {
        return $this->hasMany(Ruta::class, 'destino_id');
    }
}
