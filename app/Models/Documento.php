<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'numero_documento',
        'fecha_registro',
        'archivo',
        'carpeta_cuatro_id'
    ];
}
