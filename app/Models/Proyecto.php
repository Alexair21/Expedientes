<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    protected $table = 'proyectos';
    protected $fillable = [
        'codigo_unico',
        'estado_inversion',
        'responsable_proyecto',
        'nombre_inversion',
        'descripcion',
        'tipo_formato',
        'situacion',
        'costo_inversion',
        'costo_actualizado',
        'registro_cierre',
        'archivo',
    ];

    public function carpeta()
    {
        return $this->hasOne(CarpetaUno::class);
    }
}
