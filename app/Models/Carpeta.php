<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;
    protected $table = 'carpetas';
    protected $fillable = ['nombre', 'proyecto_id'];
    public $timestamps = false;

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    
}
