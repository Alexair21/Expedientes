<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use App\Models\CarpetaUno;
use App\Models\Proyecto;
use App\Models\Expediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proyecto::with('carpeta');

        if ($request->has('search')) {
            $query->where('codigo_unico', 'like', '%' . $request->input('search') . '%');
        }

        $proyectos = $query->paginate(10);

        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'codigo_unico' => 'required|unique:proyectos',
            'responsable_proyecto' => 'required',
            'estado_proyecto' => 'required',
            'nombre_proyecto' => 'required',
            'descripcion' => 'required',
            'tipo_formato' => 'required',
            'situacion' => 'required',
            'costo_proyecto' => 'required',
            'registro_cierre' => 'required',
            'archivo' => 'required|file',
        ], [
            'codigo_unico.required' => 'El código único es obligatorio.',
            'codigo_unico.unique' => 'El código único está en uso.',
            'responsable_proyecto.required' => 'El responsable del proyecto es obligatorio.',
            'estado_proyecto.required' => 'El estado del proyecto es obligatorio.',
            'nombre_proyecto.required' => 'El nombre del proyecto es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'tipo_formato.required' => 'El tipo de formato es obligatorio.',
            'situacion.required' => 'La situación es obligatoria.',
            'costo_proyecto.required' => 'El costo del proyecto es obligatorio.',
            'registro_cierre.required' => 'El registro de cierre es obligatorio.',
            'archivo.required' => 'El archivo es obligatorio.',
        ]);


        // Obtener el archivo del formulario
        $archivo = $request->file('archivo');

        // Generar un nombre único para el archivo
        $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();

        // Mover el archivo a una carpeta dentro de la carpeta public
        $rutaArchivo = $archivo->move('archivos_proyectos', $nombreArchivo);

        // Crear el nuevo proyecto con el identificador de archivos
        $proyecto = new Proyecto();
        $proyecto->codigo_unico = $request->codigo_unico;
        $proyecto->responsable_proyecto = $request->responsable_proyecto;
        $proyecto->estado_proyecto = $request->estado_proyecto;
        $proyecto->nombre_proyecto = $request->nombre_proyecto;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->tipo_formato = $request->tipo_formato;
        $proyecto->situacion = $request->situacion;
        $proyecto->costo_proyecto = $request->costo_proyecto;
        $proyecto->costo_actualizado = $request->costo_actualizado ?? 0;
        $proyecto->registro_cierre = $request->registro_cierre;
        $proyecto->archivo = $rutaArchivo;
        $proyecto->save();

        //crear una carpeta para el proyecto
        $carpetaUno = new CarpetaUno();
        $carpetaUno->nombre = 'Proyecto' . $proyecto->id;
        $carpetaUno->proyecto_id = $proyecto->id;
        $carpetaUno->save();

        // Guardar el ID de la carpeta en la sesión
        session(['carpetaUno_id' => $carpetaUno->id]);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        $carpetas = Carpeta::all();
        return view('proyectos.show', [
            'proyecto' => $proyecto,
            'proyecto_id' => $proyecto->id,
            'carpetas' => $carpetas
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $estados = ['ACTIVADO', 'DESACTIVADO'];
        $tiposFormato = ['PROYECTO', 'IOARR'];
        $situaciones = ['VIABLE', 'EN FORMULACION', 'APROBADO'];

        return view('proyectos.edit', compact('proyecto', 'estados', 'tiposFormato', 'situaciones'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'estado_proyecto' => 'required',
            'responsable_proyecto' => 'required',
            'nombre_proyecto' => 'required',
            'descripcion' => 'required',
            'tipo_formato' => 'required',
            'situacion' => 'required',
            'costo_proyecto' => 'required',
            'costo_actualizado' => 'required',
            'registro_cierre' => 'required',
            'archivo' => 'sometimes|file',
        ], [
            'estado_proyecto.required' => 'El estado del proyecto es obligatorio.',
            'responsable_proyecto.required' => 'El responsable del proyecto es obligatorio.',
            'nombre_proyecto.required' => 'El nombre del proyecto es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'tipo_formato.required' => 'El tipo de formato es obligatorio.',
            'situacion.required' => 'La situación es obligatoria.',
            'costo_proyecto.required' => 'El costo del proyecto es obligatorio.',
            'costo_actualizado.required' => 'El costo actualizado es obligatorio.',
            'registro_cierre.required' => 'El registro de cierre es obligatorio.',
        ]);

        $proyecto = Proyecto::findOrfail($proyecto->id);

        // Si se proporciona un nuevo archivo, actualízalo y elimina el antiguo
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();
            $rutaArchivo = $archivo->move('archivos_proyectos', $nombreArchivo, 'public');

            // Eliminar el archivo antiguo si existe
            if ($proyecto->archivo) {
                Storage::delete($proyecto->archivo);
            }

            $proyecto->archivo = $rutaArchivo;
        }

        // Actualiza los campos, excepto el código único
        $proyecto->responsable_proyecto = $request->responsable_proyecto;
        $proyecto->estado_proyecto = $request->estado_proyecto;
        $proyecto->nombre_proyecto = $request->nombre_proyecto;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->tipo_formato = $request->tipo_formato;
        $proyecto->situacion = $request->situacion;
        $proyecto->costo_proyecto = $request->costo_proyecto;
        $proyecto->costo_actualizado = $request->costo_actualizado;
        $proyecto->registro_cierre = $request->registro_cierre;
        $proyecto->save();

        // Almacenar los datos actualizados en la sesión
        session()->flash('datos_actualizados', $proyecto);

        return redirect()->route('proyectos.edit', $proyecto->id)->with('success', 'Proyecto actualizado correctamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto = Proyecto::findOrfail($proyecto->id);
        if (Storage::exists($proyecto->archivo)) {
            Storage::delete($proyecto->archivo);
        }
        $proyecto->delete();
        return redirect()->route('proyectos.index');
    }

    public function buscarProyecto(Request $request)
    {
        $request->validate([
            'codigo_unico' => 'required|string', // Ajusta la validación según tu necesidad
        ]);

        $codigoUnico = $request->codigo_unico;

        $proyecto = Proyecto::where('codigo_unico', $codigoUnico)->first();

        if ($proyecto) {
            return response()->json(['success' => true, 'proyecto' => $proyecto]);
        } else {
            return response()->json(['success' => false, 'message' => 'No se encontró ningún proyecto con el código único proporcionado.']);
        }
    }
}
