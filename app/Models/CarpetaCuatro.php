<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetaCuatro extends Model
{
    use HasFactory;
    protected $table = 'carpeta_cuatros';
    protected $fillable = ['nombre','nombre_archivo','archivo','carpeta_tres_id'];

    public function carpeta_tres(){
        return $this->belongsTo(CarpetaTres::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
