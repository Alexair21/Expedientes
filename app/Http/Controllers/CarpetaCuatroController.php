<?php

namespace App\Http\Controllers;

use App\Models\CarpetaCuatro;
use App\Models\CarpetaTres;
use App\Models\Documento;
use Illuminate\Http\Request;

class CarpetaCuatroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carpeta_tres_id = $request->input('carpeta_tres');
        $carpeta_tres = CarpetaTres::findOrFail($carpeta_tres_id);

        // Obtener el parámetro de búsqueda
        $search = $request->input('search');

        // Filtrar los resultados basados en el parámetro de búsqueda
        $carpeta_cuatro = CarpetaCuatro::where('carpeta_tres_id', $carpeta_tres_id)
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nombre_archivo', 'like', '%' . $search . '%')
                      ->orWhere('numero_archivo', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('carpeta_cuatro.index', compact('carpeta_tres', 'carpeta_cuatro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $carpeta_tres = $request->carpeta_tres;
        return view('carpeta_cuatro.create', compact('carpeta_tres'));
    }

    public function arch(Request $request)
    {
        $carpeta_tres = $request->carpeta_tres;
        return view('carpeta_cuatro.create2', compact('carpeta_tres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos comunes
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'carpeta_tres_id' => 'required|exists:carpeta_tres,id',
        ]);


        // Si el archivo está presente, realizar validación y manejo específico
        if ($request->hasFile('archivo')) {
            $request->validate([
                'archivo' => 'file|mimes:pdf,doc,docx,zip',
                'nombre_archivo' => 'required|string|max:255',
            ]);

            // Obtener el archivo del formulario
            $archivo = $request->file('archivo');

            // Generar un nombre único para el archivo
            $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();

            // Mover el archivo a una carpeta dentro de la carpeta "archivos1" en el almacenamiento público
            $rutaArchivo = $archivo->move('carpeta_cuatro', $nombreArchivo, 'public');

            // Crear la subcarpeta con archivo
            CarpetaCuatro::create([
                'nombre' => $request->input('nombre'),
                'nombre_archivo' => $request->input('nombre_archivo'),
                'numero_archivo' => $request->input('numero_archivo'),
                'fecha_registro' => $request->input('fecha_registro'),
                'carpeta_tres_id' => $request->input('carpeta_tres_id'),
                'archivo' => $rutaArchivo,
            ]);
        } else {
            // Validar los campos específicos para la creación de subcarpetas sin archivo
            $request->validate([
                'nombre' => 'required|string|max:255',
            ]);

            // Obtener la fecha actual
            $fechaActual = now()->toDateString();
            // Crear la subcarpeta sin archivo
            CarpetaCuatro::create([
                'nombre' => $request->input('nombre'),
                'fecha_registro' => $fechaActual,
                'carpeta_tres_id' => $request->input('carpeta_tres_id'),
            ]);
        }

        return redirect()->route('carpetacuatro.index', ['carpeta_tres' => $request->input('carpeta_tres_id')])->with('success', 'Registro creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carpeta_cuatro = CarpetaCuatro::findOrFail($id);
        $documentos = Documento::where('carpeta_cuatro_id', $carpeta_cuatro->id)->get();
        return view('documentos.index', compact('carpeta_cuatro', 'documentos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarpetaTres $carpetaDos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarpetaTres $carpetaDos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carpetaCuatro = CarpetaCuatro::findOrFail($id);
        $carpetaCuatro->delete();

        return redirect()->route('carpetacuatro.index', ['carpeta_tres' => $carpetaCuatro->carpeta_tres_id])->with('success', 'Registro eliminado con éxito.');
    }
}
