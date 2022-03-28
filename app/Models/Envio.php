<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Envio extends Model
{
    use HasFactory, SoftDeletes;

    public function remitente()
    {
        return $this->belongsTo(Cliente::class, 'remitente_id');
    }

    public function destinatario()
    {
        return $this->belongsTo(Cliente::class, 'destinatario_id');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'lote_id');
    }

    public function consignatario()
    {
        return $this->belongsTo(Empleado::class, 'consignatario_id');
    }

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'envio_id');
    }
}
