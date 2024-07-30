<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**public function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        //se hace referencia a solo los metodos que va a usa, en este caso colo crear
        $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
        //se hace referencia a solo los metodos que va a usa, en este caso colo editar
        $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
        //se hace referencia a solo los metodos que va a usa, en este caso colo borrar
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);

    }*/

    public function index()
    {
        $roles = Role::paginate(5);
        $permissions = Permission::get();
        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::create($validatedData);

        // Retrieve permission models from the provided IDs
        $permission = Permission::whereIn('id', $request->permission)->get();

        // Sync the permissions with the role
        $role->syncPermissions($permission);
        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'permissions' => 'required|array', // Asegúrate de recibir un array de permisos
        ]);

        $role = Role::findOrFail($id);
        $role->name = $validatedData['name'];
        $role->save();

        // Retrieve permission models from the provided IDs
        $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();

        // Sync the permissions with the role
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('info', 'Rol eliminado con éxito');
    }
}
