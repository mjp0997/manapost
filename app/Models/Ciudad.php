<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ciudades';

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'ciudad_id');
    }
}
