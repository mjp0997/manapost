<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
