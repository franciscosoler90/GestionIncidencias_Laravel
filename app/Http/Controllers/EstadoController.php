<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{

    public function getEstadoById($id)
    {
        // Obtener el prioridad por ID
        $estado = Estado::find($id);

        // Verificar si el prioridad existe
        if ($estado) {
            // Retornar una respuesta JSON con el estado
            return response()->json([
                'success' => true,
                'estado' => $estado
            ]);
        } else {
            // Retornar una respuesta de error en caso de que el estado no exista
            return response()->json([
                'success' => false,
                'message' => 'Estado no encontrado'
            ]);
        }

    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        // Crear una nueva instancia del modelo Estado
        $estado = new Estado();
        $estado->nombre = $request->input('nombre');

        // Guardar la marca en la base de datos
        if (!$estado->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error, el estado en la base de datos. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('estados')->with('success', 'El estado '.$estado->nombre.' se ha agregado correctamente');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estado $estado)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreModal' => 'required|string|max:50',
        ]);


        // Actualizar los campos del estado
        $estado->nombre = $request->input('nombreModal');

         if (!$estado->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error, el estado en la base de datos. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('estados')->with('success', 'El estado '.$estado->nombre.' se ha editado correctamente');

    }

}