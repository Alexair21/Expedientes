<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetasI extends Model
{
    use HasFactory;
    protected $table = 'carpetas_i_s';
    protected $fillable = [
        'nombre',
        'archivos_i_id'
    ];

    public $timesstamps = false;
}

