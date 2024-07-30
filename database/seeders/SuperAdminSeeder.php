<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => '12345678', // No cifrar aquí
        ]);

        // Crear el rol Super Admin
        $rolSuperAdmin = Role::create(['name' => 'Super Admin']);
        $permisosSuperAdmin = Permission::pluck('id', 'id')->all();
        $rolSuperAdmin->syncPermissions($permisosSuperAdmin);
        $superAdmin->assignRole($rolSuperAdmin->id);

        // Crear el rol Buscador
        $rolBuscador = Role::create(['name' => 'Buscador']);
        $permisosBuscador = Permission::whereIn('name', ['ver-busquedas'])->pluck('id', 'id')->all();
        $rolBuscador->syncPermissions($permisosBuscador);

        // Crear el usuario Buscador
        $usuarioBuscador = User::create([
            'name' => 'Buscador User',
            'last_name' => 'User',
            'email' => 'buscador@gmail.com',
            'password' => '12345678', // No cifrar aquí
        ]);
        $usuarioBuscador->assignRole($rolBuscador->id);

        // Crear el rol Registrador
        $rolRegistrador = Role::create(['name' => 'Registrador']);
        $permisosRegistrador = Permission::whereIn('name', ['acciones-proyecto', 'acciones-expediente','acciones-internas','acciones-carpetas','acciones-externos'])->pluck('id', 'id')->all();
        $rolRegistrador->syncPermissions($permisosRegistrador);

        // Crear el usuario Registrador
        $usuarioRegistrador = User::create([
            'name' => 'Registrador User',
            'last_name' => 'User',
            'email' => 'registrador@gmail.com',
            'password' => '12345678', // No cifrar aquí
        ]);
        $usuarioRegistrador->assignRole($rolRegistrador->id);
    }
}
