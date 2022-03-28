<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use HasFactory, SoftDeletes;

    public function origen()
    {
        return $this->belongsTo(Sucursal::class, 'origen_id');
    }

    public function destino()
    {
        return $this->belongsTo(Sucursal::class, 'destino_id');
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class, 'ruta_id');
    }
}
