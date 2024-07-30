<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CarpetaCuatro;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carpeta_cuatro = CarpetaCuatro::findOrFail($request->carpeta_cuatro);

        $query = Documento::where('carpeta_cuatro_id', $carpeta_cuatro->id);

        if ($request->has('buscar')) {
            $buscar = $request->input('buscar');
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                  ->orWhere('numero_documento', 'like', "%$buscar%");
            });
        }

        $documentos = $query->get();

        return view('documentos.index', compact('carpeta_cuatro', 'documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $carpeta_cuatro = $request->carpeta_cuatro;
        return view('documentos.create', compact('carpeta_cuatro'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required',
            'numero_documento' => 'required',
            'fecha_registro' => 'required',
            'archivo' => 'required',
            'carpeta_cuatro_id' => 'required',
        ]);

        // Obtener el archivo del formulario
        $archivo = $request->file('archivo');
        // Generar un nombre único para el archivo
        $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();
        // Mover el archivo a una carpeta dentro de la carpeta "backups" en el almacenamiento público
        $rutaArchivo = $archivo->move('documentoss', $nombreArchivo, 'public');


        // Crear una nueva instancia de Documento con la ruta del archivo
        Documento::create([
            'nombre' => $request->nombre,
            'numero_documento' => $request->numero_documento,
            'fecha_registro' => $request->fecha_registro,
            'archivo' => $rutaArchivo,
            'carpeta_cuatro_id' => $request->carpeta_cuatro_id,
        ]);

        return redirect()->route('documentos.index', ['carpeta_cuatro' => $request->carpeta_cuatro_id])->with('success', 'Documento creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        $carpeta_cuatro = CarpetaCuatro::findOrFail($documento->carpeta_cuatro_id)->id;
        return view('documentos.edit', compact('documento', 'carpeta_cuatro'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required',
            'numero_documento' => 'required',
            'fecha_registro' => 'required',
            'archivo' => 'sometimes|file',
            'carpeta_cuatro_id' => 'required',
        ]);

        // Obtener el documento
        $documento = Documento::findOrFail($id);

        // Eliminar el archivo anterior si se sube uno nuevo
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();
            $rutaArchivo = $archivo->move('documentoss', $nombreArchivo, 'public');

            if ($documento->archivo) {
                Storage::delete($documento->archivo);
            }

            $documento->archivo = $rutaArchivo;
        }

        // Actualizar el documento
        $documento->nombre = $request->nombre;
        $documento->numero_documento = $request->numero_documento;
        $documento->fecha_registro = $request->fecha_registro;
        $documento->carpeta_cuatro_id = $request->carpeta_cuatro_id;
        $documento->save();

        return redirect()->route('documentos.index', ['carpeta_cuatro' => $request->carpeta_cuatro_id])->with('success', 'Documento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();

        return redirect()->route('documentos.index', ['carpeta_cuatro' => $documento->carpeta_cuatro_id])->with('success', 'Documento eliminado exitosamente.');
    }
}
