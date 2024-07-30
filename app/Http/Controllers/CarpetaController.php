<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Subcarpeta;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $proyecto_id = $request->proyecto_id;
        return view('carpetas.create', compact('proyecto_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'proyecto_id' => 'required',
        ], [
            'nombre.required' => 'El nombre de la carpeta es obligatorio.',
        ]);

        Carpeta::create($request->all());
        // Redirigir a la vista de índice con un mensaje de éxito
        $proyecto_id = $request->proyecto_id;
        $proyecto = Proyecto::findOrFail($proyecto_id);
        $carpetas = Carpeta::all();
        return redirect()->route('proyectos.show', compact('carpetas', 'proyecto_id', 'proyecto'))->with('success', 'Carpeta creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carpeta $carpeta)
    {
        $subcarpetas = Subcarpeta::where('carpeta_id', $carpeta->id)->get();
        $archivos = Subcarpeta::where('carpeta_id', $carpeta->id)->whereNotNull('nombre_archivo')->get();
        $tieneArchivos = $archivos->count() > 0;
        $tieneSubcarpetas = $subcarpetas->whereNull('nombre_archivo')->count() > 0;
        $carpeta = Carpeta::findOrFail($carpeta->id);
        $proyecto = Proyecto::findOrFail($carpeta->proyecto_id);
        return view('carpetas.show', [
            'carpeta_id' => $carpeta->id,
            'subcarpetas' => $subcarpetas,
            'archivos' => $archivos,
            'tieneArchivos' => $tieneArchivos,
            'tieneSubcarpetas' => $tieneSubcarpetas,
            'carpeta' => $carpeta,
            'proyecto' => $proyecto,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carpeta $carpeta)
    {
        $proyecto_id = $carpeta->proyecto_id;
        return view('carpetas.edit', compact('carpeta', 'proyecto_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carpeta $carpeta)
    {
        $request->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El nombre de la carpeta es obligatorio.',
        ]);

        $carpeta->update($request->all());
        return redirect()->route('proyectos.show', $carpeta->proyecto_id)->with('success', 'Carpeta actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carpeta $carpeta)
    {
        $carpeta->delete();
        return redirect()->back()->with('success', 'Carpeta eliminada con éxito.');
    }
}
