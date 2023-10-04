<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Cliente;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class IncidenciaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'idCliente' => 'required|integer|exists:clientes,id',
            'departamento' => 'required|integer|exists:departamentos,id',
            'idPrioridad' => 'required|integer|exists:estados,id',
            'idFacturacion' => 'required|integer|exists:facturacion,id',
            'empleado' => 'nullable|integer|exists:empleados,id',
            'titulo' => 'required|string',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file',
        ]);
        
        // Buscar el cliente correspondiente
        $cliente = Cliente::find($validatedData['idCliente']);

        // Crear el nuevo registro de incidencia en la base de datos
        $incidencia = new Incidencia();
        $incidencia->cliente()->associate($cliente);
        
        // Obtener la fecha y hora del campo "Fecha"
        $fecha = now()->addHours(2)->format('Y-m-d\TH:i:s\Z');

        $incidencia->fechaCreacion = $fecha;
        $incidencia->fechaActualizacion = $fecha;        
        
        $incidencia->idUsuario = auth()->user()->id;
        $incidencia->idPrioridad = $validatedData['idPrioridad'];
        $incidencia->idEstado = 1;

        $incidencia->titulo = $validatedData['titulo'];
        $incidencia->descripcion = $validatedData['descripcion'];

        $incidencia->idDepartamento = $validatedData['departamento'];
        $incidencia->idFacturacion = $validatedData['idFacturacion'];

        $incidencia->idEmpleado = $validatedData['empleado'];

        // Guardar el archivo en la base de datos
        $archivo = $request->file('archivo');
        
        if ($archivo) {
            try {
                // Obtener el nombre del archivo y guardarlo en la base de datos
                $incidencia->nombreArchivo = $archivo->getClientOriginalName();
        
                $contenido = fread(fopen($archivo->getRealPath(), "r"), $archivo->getSize());
        
                $incidencia->archivo = DB::raw("0x" . bin2hex($contenido));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Ha ocurrido un error al guardar el archivo de la incidencia. Por favor, inténtalo de nuevo.');
            }
        }
        
        if (!$incidencia->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al guardar la incidencia en la base de datos. Por favor, inténtalo de nuevo.');
        }

        // Obtener las areas seleccionadas del formulario
        $areasSeleccionadas = $request->input('areas', []);

        // Actualizar la relación entre la incidencia y las areas
        $incidencia->areas()->attach($areasSeleccionadas);
        
        return redirect()->route('incidencias')->with('success', 'La incidencia se ha creado correctamente');
        
    }

    public function download($id)
    {
        $incidencia = Incidencia::find($id);
        if (!$incidencia) {
            return abort(404);
        }
        $archivo = $incidencia->archivo;
        $nombreArchivo = $incidencia->nombreArchivo;
        return response($archivo, 200)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $nombreArchivo . '"');
    }

    public function getIncidencia($id) {
        $incidencia = Incidencia::find($id);
    
        if (!$incidencia) {
            return response()->json(['error' => 'Incidencia no encontrada'], 404);
        }
    
        return response()->json($incidencia);
    }

    public function areas(Request $request, $id)
    {
        $incidencia = Incidencia::find($id);
    
        if (!$incidencia) {
            return response()->json([
                'message' => 'Incidencia no encontrada'
            ], 404);
        }
    
        $areas = $incidencia->areas;
    
        return response()->json($areas);
    }

}