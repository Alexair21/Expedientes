<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetaDos extends Model
{
    use HasFactory;

    protected $table = 'carpeta_dos';
    protected $fillable = ['nombre','nombre_archivo','numero_archivo','fecha_registro','archivo','carpeta_uno_id'];

    public function carpeta_uno(){
        return $this->belongsTo(CarpetaUno::class);
    }

    public function carpetaTres()
    {
        return $this->hasMany(CarpetaTres::class);
    }

}
