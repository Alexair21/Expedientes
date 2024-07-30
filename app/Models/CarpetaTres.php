<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetaTres extends Model
{
    use HasFactory;
    protected $table = 'carpeta_tres';
    protected $fillable = ['nombre','nombre_archivo','numero_archivo','fecha_registro','archivo','carpeta_dos_id'];

    public function carpeta_dos(){
        return $this->belongsTo(CarpetaDos::class);
    }

    public function carpetaCuatro()
    {
        return $this->hasMany(CarpetaCuatro::class);
    }

    
}
