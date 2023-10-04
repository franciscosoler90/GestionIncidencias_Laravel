<?php

namespace App\Http\Controllers;

use App\Models\Prioridad;
use Illuminate\Http\Request;

class PrioridadController extends Controller
{

    public function getPrioridadById($id)
    {
        // Obtener el prioridad por ID
        $prioridad = Prioridad::find($id);

        // Verificar si el prioridad existe
        if ($prioridad) {
            // Retornar una respuesta JSON con el prioridad
            return response()->json([
                'success' => true,
                'prioridad' => $prioridad
            ]);
        } else {
            // Retornar una respuesta de error en caso de que el prioridad no exista
            return response()->json([
                'success' => false,
                'message' => 'Prioridad no encontrado'
            ]);
        }

    }
}