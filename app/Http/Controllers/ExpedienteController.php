<?php

namespace App\Http\Controllers;

use App\Models\CarpetaUno;
use App\Models\Documento;
use App\Models\Expediente;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $expedientes = Expediente::query()
            ->when($search, function ($query, $search) {
                return $query->where('numero_expediente', 'like', "%{$search}%")
                    ->orWhere('nombre_documento', 'like', "%{$search}%");
            })
            ->paginate(10);

        $query = Expediente::with('carpeta');

        if($request->has('search')) {
            $query->where('numero_expediente', 'like', '%' . $request->input('search') . '%');
        }

        return view('expediente.index', compact('expedientes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('expediente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'numero_expediente' => 'required|unique:expedientes',
            'nombre_documento' => 'required',
            'encargado' => 'required',
            'fecha_emision' => 'required',
            'hora_emision' => 'required',
            'area_remitida' => 'required',
            'archivo' => 'required|file',
        ]);

        // Obtener el archivo del formulario
        $archivo = $request->file('archivo');

        // Generar un nombre único para el archivo
        $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();

        // Mover el archivo a una carpeta dentro de la carpeta "backups" en el almacenamiento público
        $rutaArchivo = $archivo->move('archivos_expedientes', $nombreArchivo, 'public');

        // Crear una nueva instancia de Expediente y guardarla
        $expediente = Expediente::create([
            'numero_expediente' => $request->numero_expediente,
            'nombre_documento' => $request->nombre_documento,
            'encargado' => $request->encargado,
            'fecha_emision' => $request->fecha_emision,
            'hora_emision' => $request->hora_emision,
            'area_remitida' => $request->area_remitida,
            'archivo' => $rutaArchivo,
        ]);

        // Crear una nueva carpeta asociada con el expediente
        $carpetaUno = new CarpetaUno();
        $carpetaUno->nombre = 'Expediente ' . $expediente->id; // Usar el ID del expediente
        $carpetaUno->expediente_id = $expediente->id; // Asignar el ID del expediente
        $carpetaUno->save();

        return redirect()->route('expedientes.index')->with('success', 'Expediente creado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
        $documentos = Documento::all();
        return view('documentos.index', [
            'expediente' => $expediente,
            'expediente_id' => $expediente->id,
            'documentos' => $documentos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expediente = Expediente::findOrFail($id);
        return view('expediente.edit', compact('expediente'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'nombre_documento' => 'required',
            'encargado' => 'required',
            'fecha_emision' => 'required',
            'hora_emision' => 'required',
            'area_remitida' => 'required',
            'archivo' => 'file',
        ], [
            'nombre_documento.required' => 'El nombre del documento es obligatorio.',
            'encargado.required' => 'El encargado es obligatorio.',
            'fecha_emision.required' => 'La fecha de emisión es obligatoria.',
            'hora_emision.required' => 'La hora de emisión es obligatoria.',
            'area_remitida.required' => 'El área remitida es obligatoria.',
            'archivo.file' => 'El archivo debe ser un archivo.',
        ]);

        // Find the Expediente instance by ID
        $expediente = Expediente::findOrFail($id);

        // Update the fields that are not related to the file
        $expediente->update($request->except('archivo'));

        // Handle file upload only if a new file is provided
        if ($request->hasFile('archivo')) {
            // Remove old file if it exists
            if (Storage::exists($expediente->archivo)) {
                Storage::delete($expediente->archivo);
            }

            $archivo = $request->file('archivo');
            $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();
            $rutaArchivo = $archivo->move('archivos_expedientes', $nombreArchivo);
            $expediente->archivo = $rutaArchivo;
            $expediente->save();
        }
        return redirect()->route('expedientes.index')->with('success', 'Expediente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expediente $expediente)
    {
        $expediente->delete();
        return redirect()->route('expedientes.index')->with('success', 'Expediente eliminado correctamente.');
    }




    public function buscarExpediente(Request $request)
    {
        $numero_expediente = $request->input('numero_expediente');
        $nombre_documento = $request->input('nombre_documento');

        $query = Expediente::query();

        if ($numero_expediente) {
            $query->where('numero_expediente', 'LIKE', "%{$numero_expediente}%");
        }

        if ($nombre_documento) {
            $query->where('nombre_documento', 'LIKE', "%{$nombre_documento}%");
        }

        $expediente = $query->first();

        if ($expediente) {
            return response()->json([
                'success' => true,
                'expediente' => $expediente
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron expedientes con los criterios de búsqueda proporcionados.'
            ]);
        }
    }
}
