<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Cliente;

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class EmpleadoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $idCliente)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $empleados = $cliente->empleados;
        
        return response()->json(['cliente' => $cliente]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'idCliente' => 'required|exists:clientes,id',
            'nombre' => 'required|string',
            'cargo' => 'nullable|string',
            'telefonoFijo' => 'nullable|string',
            'telefonoMovil' => 'nullable|string',
            'correoEmpresa' => 'nullable|string',
            'correoPersonal' => 'nullable|string',
        ]);
    
        // Buscar el cliente correspondiente
        $cliente = Cliente::find($validatedData['idCliente']);
    
        if (!$cliente) {
            return new JsonResponse(['success' => false, 'message' => 'Cliente no encontrado.']);
        }
    
        // Crear el nuevo registro de empleado en la base de datos
        $empleado = new Empleado();
        $empleado->cliente()->associate($cliente);
    
        $empleado->nombre = $validatedData['nombre'];
        $empleado->cargo = $validatedData['cargo'];
        $empleado->telefonoFijo = $validatedData['telefonoFijo'];
        $empleado->telefonoMovil = $validatedData['telefonoMovil'];
        $empleado->correoEmpresa = $validatedData['correoEmpresa'];
        $empleado->correoPersonal = $validatedData['correoPersonal'];
    
        if (!$empleado->save()) {
            return new JsonResponse(['success' => false, 'message' => 'Ha ocurrido un error al guardar el empleado en la base de datos. Por favor, inténtalo de nuevo.']);
        }
    
        $empleados = Empleado::where('idCliente', $validatedData['idCliente'])->get();
    
        return new JsonResponse(['success' => true, 'empleados' => $empleados, 'message' => 'El empleado se ha creado correctamente']);
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'cargo' => 'nullable|string',
            'telefonoFijo' => 'nullable|string',
            'telefonoMovil' => 'nullable|string',
            'correoEmpresa' => 'nullable|string',
            'correoPersonal' => 'nullable|string',
        ]);
    
        $empleado = Empleado::find($id);
    
        if (!$empleado) {
            return redirect()->back()->with('error', 'El empleado '.$id.' no existe en la base de datos.');
        }        
    
        // Actualizar los datos del empleado
        $empleado->nombre = $request->input('nombre');
        $empleado->cargo = $request->input('cargo');
        $empleado->telefonoFijo = $request->input('telefonoFijo');
        $empleado->telefonoMovil = $request->input('telefonoMovil');
        $empleado->correoEmpresa = $request->input('correoEmpresa');
        $empleado->correoPersonal = $request->input('correoPersonal');
    
        if (!$empleado->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al editar el empleado en la base de datos. Por favor, inténtalo de nuevo.');
        }
    
        return redirect()->route('clientes')->with('success', 'El empleado '.$empleado->nombre.' se ha editado correctamente');
    }
    
    public function getEmpleadosCliente($idCliente) {
        $empleados = Empleado::where('idCliente', $idCliente)->get();
    
        if (!$empleados) {
            return response()->json(['error' => 'Empleados no encontrados'], 404);
        }
    
        return response()->json($empleados);
    }

    public function getEmpleadoById($id)
    {
        // Obtener el prioridad por ID
        $empleado = Empleado::find($id);

        // Verificar si el empleado existe
        if ($empleado) {
            // Retornar una respuesta JSON con el empleado
            return response()->json([
                'success' => true,
                'empleado' => $empleado
            ]);
        } else {
            // Retornar una respuesta de error en caso de que el empleado no exista
            return response()->json([
                'success' => false,
                'message' => 'Empleado no encontrado'
            ]);
        }

    }
    
}