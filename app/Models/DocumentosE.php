<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosE extends Model
{
    use HasFactory;
    protected $table = 'documentos_e_s';
    protected $fillable = [
        'nombre',
        'fecha_registro',
        'archivo',
    ];

    public $timesstamps = false;
}
