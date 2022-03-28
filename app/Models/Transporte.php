<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model
{
    use HasFactory, SoftDeletes;

    public function chofer()
    {
        return $this->belongsTo(Empleado::class, 'chofer_id');
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class, 'transporte_id');
    }
}
