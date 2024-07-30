<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcarpetasI extends Model
{
    use HasFactory;
    protected $table = 'subcarpetas_i_s';
    protected $fillable = [
        'nombre',
        'carpeta_i_id'
    ];

    public $timesstamps = false;
}

