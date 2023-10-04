<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{

    public function getDepartamentoById($id)
    {
        // Obtener el departamento por ID
        $departamento = Departamento::find($id);

        // Verificar si existe
        if ($departamento) {
            // Retornar una respuesta JSON
            return response()->json([
                'success' => true,
                'departamento' => $departamento
            ]);
        } else {
            // Retornar una respuesta de error en caso de que no exista
            return response()->json([
                'success' => false,
                'message' => 'Departamento no encontrado'
            ]);
        }

    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        // Crear una nueva instancia del modelo Departamento
        $departamento = new Departamento();
        $departamento->nombre = $request->input('nombre');

        // Guardar la marca en la base de datos
        if (!$departamento->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error, el departamento en la base de datos. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('departamentos')->with('success', 'El departamento '.$departamento->nombre.' se ha agregado correctamente');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departamento $departamento)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreModal' => 'required|string|max:50',
        ]);


        // Actualizar los campos de la marca
        $departamento->nombre = $request->input('nombreModal');

         if (!$departamento->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error, el departamento en la base de datos. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('departamentos')->with('success', 'El departamento '.$departamento->nombre.' se ha editado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        // Eliminar el departamento
        if (!$departamento->delete()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al eliminar el departamento. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('departamentos')->with('success', 'El departamento '.$departamento->nombre.' se ha eliminado correctamente');
    }
}
