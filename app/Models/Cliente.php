<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    public function enviosRealizados()
    {
        return $this->hasMany(Envio::class, 'remitente_id');
    }

    public function enviosRecibidos()
    {
        return $this->hasMany(Envio::class, 'destinatario_id');
    }
}
