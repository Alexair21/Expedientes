<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosI extends Model
{
    use HasFactory;
    protected $table = 'documentos_i_s';
    protected $fillable = [
        'nombre',
        'fecha_registro',
        'archivo',
        'subcarpeta_i_id'
    ];

    public $timesstamps = false;
}
