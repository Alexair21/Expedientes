<?php

namespace App\Http\Controllers;

use App\Models\CarpetaDos;
use App\Models\CarpetaUno;
use Illuminate\Http\Request;

class CarpetaUnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carpeta_uno.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carpeta_uno = CarpetaUno::findOrFail($id);
        $carpetaDos = CarpetaDos::where('carpeta_uno_id', $id)->get();

        return view('carpeta_dos.index', compact('carpeta_uno', 'carpetaDos'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarpetaUno $carpetaUno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarpetaUno $carpetaUno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarpetaUno $carpetaUno)
    {
        //
    }
}
