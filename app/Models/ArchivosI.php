<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivosI extends Model
{
    use HasFactory;
    protected $table = 'archivos_i_s';
    protected $fillable = [
        'nombre',
    ];

    public $timesstamps = false;
}
