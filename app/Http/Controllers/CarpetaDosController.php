<?php

namespace App\Http\Controllers;

use App\Models\CarpetaDos;
use App\Models\CarpetaUno;
use App\Models\CarpetaTres;
use Illuminate\Http\Request;

class CarpetaDosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carpeta_uno_id = $request->input('carpeta_uno');
        $carpeta_uno = CarpetaUno::findOrFail($carpeta_uno_id);

        // Obtener el parámetro de búsqueda
        $search = $request->input('search');

        // Filtrar los resultados basados en el parámetro de búsqueda
        $carpetaDos = CarpetaDos::where('carpeta_uno_id', $carpeta_uno_id)
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nombre_archivo', 'like', '%' . $search . '%')
                      ->orWhere('numero_archivo', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('carpeta_dos.index', compact('carpetaDos', 'carpeta_uno'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $carpeta_uno = $request->carpeta_uno;
        return view('carpeta_dos.create', compact('carpeta_uno'));
    }

    public function arch(Request $request)
    {
        $carpeta_uno = $request->carpeta_uno;
        return view('carpeta_dos.create2', compact('carpeta_uno'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos comunes
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'carpeta_uno_id' => 'required|exists:carpeta_unos,id',
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
            $rutaArchivo = $archivo->move('carpeta_dos', $nombreArchivo, 'public');

            // Crear la subcarpeta con archivo
            CarpetaDos::create([
                'nombre' => $request->input('nombre'),
                'nombre_archivo' => $request->input('nombre_archivo'),
                'numero_archivo' => $request->input('numero_archivo'),
                'fecha_registro' => $request->input('fecha_registro'),
                'carpeta_uno_id' => $request->input('carpeta_uno_id'),
                'archivo' => $rutaArchivo,
            ]);
        } else {
            // Validar los campos específicos para la creación de subcarpetas sin archivo
            $request->validate([
                'nombre' => 'required|string|max:255',
            ]);

            $fechaActual = now()->toDateString();
            // Crear la subcarpeta sin archivo
            CarpetaDos::create([
                'nombre' => $request->input('nombre'),
                'fecha_registro' => $fechaActual,
                'carpeta_uno_id' => $request->input('carpeta_uno_id'),
            ]);
        }

        return redirect()->route('carpetados.index', ['carpeta_uno' => $request->input('carpeta_uno_id')])->with('success', 'Acción realizada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carpeta_dos = CarpetaDos::findOrFail($id);
        $carpeta_tres = CarpetaTres::where('carpeta_dos_id', $carpeta_dos->id)->get();
        return view('carpeta_tres.index', compact('carpeta_dos','carpeta_tres'));
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
        $carpetaDos = CarpetaDos::findOrFail($id);
        $carpetaDos->delete();

        return redirect()->route('carpetados.index', ['carpeta_uno' => $carpetaDos->carpeta_uno_id])->with('success', 'Registro eliminado con éxito.');
    }
}
