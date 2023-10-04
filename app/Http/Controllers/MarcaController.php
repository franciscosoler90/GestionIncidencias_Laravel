<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        // Crear una nueva instancia del modelo Marca
        $marca = new Marca();
        $marca->nombre = $request->input('nombre');

        // Guardar la marca en la base de datos
        if (!$marca->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error, la marca en la base de datos. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('marcas')->with('success', 'La marca '.$marca->nombre.' se ha agregado correctamente');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreModal' => 'required|string|max:50',
        ]);


        // Actualizar los campos de la marca
        $marca->nombre = $request->input('nombreModal');

         if (!$marca->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error, la marca en la base de datos. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('marcas')->with('success', 'La marca '.$marca->nombre.' se ha editado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        // Eliminar la marca
        if (!$marca->delete()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al eliminar la marca. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('marcas')->with('success', 'La marca '.$marca->nombre.' se ha eliminado correctamente');
    }
}