<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetaUno extends Model
{
    use HasFactory;

    protected $table = 'carpeta_unos';
    protected $fillable = ['nombre'];


}
