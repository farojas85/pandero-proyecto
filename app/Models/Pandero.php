<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pandero extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion', 'monto', 'fecha_inicio', 'es_activo'
    ];
}
