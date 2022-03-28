<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['edad'];

    public function getEdadAttribute()
    {
        $diferencia = date_diff(date_create($this->fecha_nacimiento), date_create(date('Y-m-d')));

        return $diferencia->format('%y');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'empleado_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function transporte()
    {
        return $this->hasOne(Transporte::class, 'chofer_id');
    }

    public function envios()
    {
        return $this->hasMany(Envio::class, 'consignatario_id');
    }
}
