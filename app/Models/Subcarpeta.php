<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcarpeta extends Model
{
    use HasFactory;

    protected $table = 'subcarpetas';
    protected $fillable = ['nombre','nombre_archivo', 'fecha_registro', 'carpeta_id', 'archivo'];

    public $timestamps = false;
    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class);
    }
}
