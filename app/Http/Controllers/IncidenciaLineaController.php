<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\IncidenciaLinea;

use App\Models\Departamento;
use App\Models\Prioridad;
use App\Models\Estado;
use App\Models\Facturacion;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class IncidenciaLineaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'idIncidencia' => 'required|integer|exists:incidencias,id',
            'idEstadoModal' => 'required|integer|exists:estados,id',
            'idPrioridadModal' => 'required|integer|exists:prioridad,id',
            'idDepartamentoModal' => 'required|integer|exists:departamentos,id',
            'idFacturacionModal' => 'required|integer|exists:facturacion,id',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file',
        ]);
    
        // Validar que la incidencia exista en la base de datos
        $incidencia = Incidencia::find($validatedData['idIncidencia']);

        if (!$incidencia) {
            return redirect()->back()->with('error', 'La incidencia no existe.');
        }

        $idUsuario = auth()->user()->id;

        $incidenciaLinea = new IncidenciaLinea();

        $incidenciaLinea->idIncidencia = $incidencia->id;
        $incidenciaLinea->idUsuario = $idUsuario;

        $fecha = now()->addHours(2)->format('Y-m-d\TH:i:s\Z');

        $incidenciaLinea->fecha = $fecha;
        $incidencia->fechaActualizacion = $fecha;

        // Verificar si la prioridad, facturación o departamento han cambiado
        $estadoCambiado = $incidencia->idEstado !== $validatedData['idEstadoModal'];
        $prioridadCambiada = $incidencia->idPrioridad !== $validatedData['idPrioridadModal'];
        $facturacionCambiada = $incidencia->idFacturacion !== $validatedData['idFacturacionModal'];
        $departamentoCambiado = $incidencia->idDepartamento !== $validatedData['idDepartamentoModal'];

        // Obtener los nombres de los elementos relacionados en la base de datos
        $estadoNombre = Estado::find($validatedData['idEstadoModal'])->nombre;
        $prioridadNombre = Prioridad::find($validatedData['idPrioridadModal'])->nombre;
        $facturacionNombre = Facturacion::find($validatedData['idFacturacionModal'])->nombre;
        $departamentoNombre = Departamento::find($validatedData['idDepartamentoModal'])->nombre;

        $incidencia->idEstado = $validatedData['idEstadoModal'];
        $incidencia->idPrioridad = $validatedData['idPrioridadModal'];
        $incidencia->idDepartamento = $validatedData['idDepartamentoModal'];
        $incidencia->idFacturacion = $validatedData['idFacturacionModal'];

        // Construir una cadena HTML que registre los cambios en la descripción
        $descripcionModificada = '';

        if ($estadoCambiado) {
            $descripcionModificada .= '<p class="mb-0"><small>Estado modificado a: <b>' . $estadoNombre . '</b>.</small></p>';
        }

        if ($prioridadCambiada) {
            $descripcionModificada .= '<p class="mb-0"><small>Prioridad modificado a: <b>' . $prioridadNombre . '</b>.</small></p>';
        }

        if ($facturacionCambiada) {
            $descripcionModificada .= '<p class="mb-0"><small>Facturación modificado a: <b>' . $facturacionNombre . '</b>.</small></p>';
        }

        if ($departamentoCambiado) {
            $descripcionModificada .= '<p class="mb-0"><small>Departamento modificado a: <b>' . $departamentoNombre . '</b>.</small></p>';
        }

        // Agregar la descripción modificada primero y luego la descripción de validatedData
        $incidenciaLinea->descripcion = $descripcionModificada . $validatedData['descripcion'];

        // Guardar el archivo en la base de datos
        $archivo = $request->file('archivo');
        
        if ($archivo) {

            try {

                // Obtener el nombre del archivo y guardarlo en la base de datos
                $incidenciaLinea->nombreArchivo = $archivo->getClientOriginalName();
                
                $contenido = fread(fopen($archivo->getRealPath(), "r"), $archivo->getSize());
                
                $incidenciaLinea->archivo = DB::raw("0x" . bin2hex($contenido));

            } catch (\Exception $e) {

                return redirect()->back()->with('error', 'Ha ocurrido un error al guardar el archivo de la incidencia. Por favor, inténtalo de nuevo.');

            }
        }

        if (!$incidenciaLinea->save() || !$incidencia->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al escribir su mensaje. Por favor, inténtalo de nuevo.');
        }

        // Obtener las areas seleccionadas del formulario
        $areasSeleccionadas = $request->input('areas', []);

        // Actualizar la relación entre el cliente y las marcas
        $incidencia->areas()->sync($areasSeleccionadas);
    
        return redirect()->back()->with('success', 'La incidencia '.$incidencia->id.' se ha editado correctamente');
    }
    
    public function download($id)
    {
        $incidenciaLinea = IncidenciaLinea::find($id);
        if (!$incidenciaLinea) {
            return abort(404);
        }
        $archivo = $incidenciaLinea->archivo;
        $nombreArchivo = $incidenciaLinea->nombreArchivo;
        return response($archivo, 200)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $nombreArchivo . '"');
    }


    public function getIncidenciaLineas($idIncidencia) {

        $incidenciaLineas = IncidenciaLinea::where('idIncidencia', $idIncidencia)->get();
    
        if (!$incidenciaLineas) {
            return response()->json(['error' => 'Incidencia lineas no encontradas'], 404);
        }
    
        return response()->json($incidenciaLineas->toArray());
    }
    
}