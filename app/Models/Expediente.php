<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $table = 'expedientes';
    protected $fillable = [
        'numero_expediente',
        'nombre_documento',
        'encargado',
        'fecha_emision',
        'hora_emision',
        'area_remitida',
        'archivo',
    ];

    public $timesstamps = false;

    public function carpeta()
    {
        return $this->hasOne(CarpetaUno::class);
    }
}
