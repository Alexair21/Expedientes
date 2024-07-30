<?php

namespace App\Http\Controllers;

use App\Models\CarpetaCuatro;
use App\Models\CarpetaDos;
use App\Models\CarpetaTres;
use Illuminate\Http\Request;

class CarpetaTresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carpeta_dos_id = $request->input('carpeta_dos');
        $carpeta_dos = CarpetaDos::findOrFail($carpeta_dos_id);

        // Obtener el parámetro de búsqueda
        $search = $request->input('search');

        // Filtrar los resultados basados en el parámetro de búsqueda
        $carpeta_tres = CarpetaTres::where('carpeta_dos_id', $carpeta_dos_id)
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nombre_archivo', 'like', '%' . $search . '%')
                      ->orWhere('numero_archivo', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('carpeta_tres.index', compact('carpeta_dos', 'carpeta_tres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $carpeta_dos = $request->carpeta_dos;
        return view('carpeta_tres.create', compact('carpeta_dos'));
    }

    public function arch(Request $request)
    {
        $carpeta_dos = $request->carpeta_dos;
        return view('carpeta_tres.create2', compact('carpeta_dos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos comunes
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'carpeta_dos_id' => 'required|exists:carpeta_dos,id',
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
            $rutaArchivo = $archivo->move('carpeta_tres', $nombreArchivo, 'public');

            // Crear la subcarpeta con archivo
            CarpetaTres::create([
                'nombre' => $request->input('nombre'),
                'nombre_archivo' => $request->input('nombre_archivo'),
                'numero_archivo' => $request->input('numero_archivo'),
                'fecha_registro' => $request->input('fecha_registro'),
                'carpeta_dos_id' => $request->input('carpeta_dos_id'),
                'archivo' => $rutaArchivo,
            ]);
        } else {
            // Validar los campos específicos para la creación de subcarpetas sin archivo
            $request->validate([
                'nombre' => 'required|string|max:255',
            ]);

            $fechaActual = now()->toDateString();

            // Crear la subcarpeta sin archivo
            CarpetaTres::create([
                'nombre' => $request->input('nombre'),
                'fecha_registro' => $fechaActual,
                'carpeta_dos_id' => $request->input('carpeta_dos_id'),
            ]);
        }

        return redirect()->route('carpetatres.index', ['carpeta_dos' => $request->input('carpeta_dos_id')])->with('success', 'Registro creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carpeta_tres = CarpetaTres::findOrFail($id);
        $carpeta_cuatro = CarpetaCuatro::where ('carpeta_tres_id', $carpeta_tres->id)->get();
        return view('carpeta_cuatro.index', compact('carpeta_tres','carpeta_cuatro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarpetaDos $carpetaDos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarpetaDos $carpetaDos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carpetaTres = CarpetaTres::findOrFail($id);
        $carpetaTres->delete();

        return redirect()->route('carpetatres.index', ['carpeta_dos' => $carpetaTres->carpeta_dos_id])->with('success', 'Registro eliminado con éxito.');
    }
}
