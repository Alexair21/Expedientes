<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; // Add this line

class SeederTablePermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //Operaciones sobre la tabla roles
            'acciones-admin',
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones
            'ver-busquedas',

            //Acciones externas
            'acciones-externos',
            'acciones-expediente',
            'acciones-proyecto',

            //Acciones internas
            'acciones-internas',

            //Acciones para gestionar las carpetas
            'acciones-carpetas'
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }

    }
}
