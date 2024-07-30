<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarpetaUno;

class CarpetaUnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carpetas = [
            'Archivos internos',
            'Archivos externos',
        ];

        foreach ($carpetas as $carpeta) {
            CarpetaUno::create([
                'nombre' => $carpeta,
            ]);
        }
    }
}
