<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'estados';

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'estado_id');
    }
}
