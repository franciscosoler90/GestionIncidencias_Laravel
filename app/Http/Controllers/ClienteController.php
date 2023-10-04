<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function getClienteById($id)
    {
        // Obtener el cliente por ID
        $cliente = Cliente::find($id);

        // Verificar si existe
        if ($cliente) {
            // Retornar una respuesta JSON
            return response()->json([
                'success' => true,
                'cliente' => $cliente
            ]);
        } else {
            // Retornar una respuesta de error en caso de que no exista
            return response()->json([
                'success' => false,
                'message' => 'Cliente no encontrado'
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
            'idNuevo' => 'required|integer',
            
            'nombreNuevo' => 'required|string',
            'nifNuevo' => 'nullable|string',
            'emailNuevo' => 'nullable|string',
            'movilNuevo' => 'nullable|string',
            'faxNuevo' => 'nullable|string',
            'telefonoNuevo' => 'nullable|string',
            'domicilioNuevo' => 'nullable|string',
            'paisNuevo' => 'nullable|string',
            'ccaaNuevo' => 'nullable|string',
            'provinciaNuevo' => 'nullable|string',
            'municipioNuevo' => 'nullable|string',
            'codigoPostalNuevo' => 'nullable|string',
            'numeroNuevo' => 'nullable|integer',
            'pisoNuevo' => 'nullable|integer',
            'escaleraNuevo' => 'nullable|string',
            'puertaNuevo' => 'nullable|string',
            'tipoClienteNuevo' => 'required|in:AUTOS,SAT',
            'observacionesNuevo' => 'nullable|string',
        ]);

        // Comprobar si ya existe un cliente con el mismo ID
        if (Cliente::where('id', $request->input('idNuevo'))->exists()) {
            return redirect()->back()->with('error', 'Ya existe un cliente con ese ID. Por favor, elige otro.');
        }

        // Crear un nuevo objeto cliente
        $cliente = new Cliente();

        // Asignar los valores del formulario al objeto cliente
        $cliente->id = $request->input('idNuevo');
        $cliente->codigo = $request->input('idNuevo');

        $cliente->nombre = $request->input('nombreNuevo');
        $cliente->nif = $request->input('nifNuevo');
        $cliente->email = $request->input('emailNuevo');
        $cliente->movil = $request->input('movilNuevo');
        $cliente->fax = $request->input('faxNuevo');
        $cliente->telefono = $request->input('telefonoNuevo');
        $cliente->domicilio = $request->input('domicilioNuevo');
        $cliente->pais = $request->input('paisNuevo');
        $cliente->ccaa = $request->input('ccaaNuevo');
        $cliente->provincia = $request->input('provinciaNuevo');
        $cliente->municipio = $request->input('municipioNuevo');
        $cliente->codigoPostal = $request->input('codigoPostalNuevo');
        $cliente->numero = $request->input('numeroNuevo');
        $cliente->piso = $request->input('pisoNuevo');
        $cliente->escalera = $request->input('escaleraNuevo');
        $cliente->puerta = $request->input('puertaNuevo');
        $cliente->tipoCliente = $request->input('tipoClienteNuevo');
        $cliente->observaciones = $request->input('observacionesNuevo');

        // Guardar el objeto cliente en la base de datos
        if (!$cliente->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al guardar el cliente en la base de datos. Por favor, inténtalo de nuevo.');
        }

        $cliente->id = $request->input('idNuevo');

        // Obtener las marcas seleccionadas del formulario
        $marcasSeleccionadas = $request->input('marcasNuevo', []);

        // Actualizar la relación entre el cliente y las marcas
        $cliente->marcas()->attach($marcasSeleccionadas);

        return redirect()->route('clientes')->with('success', 'El cliente '.$cliente->nombre.' se ha creado correctamente.');
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreModal' => 'required|string',
            'codigoModal' => 'required|integer',
            'nifModal' => 'nullable|string',
            'emailModal' => 'nullable|string',
            'movilModal' => 'nullable|string',
            'faxModal' => 'nullable|string',
            'telefonoModal' => 'nullable|string',
            'domicilioModal' => 'nullable|string',
            'paisModal' => 'nullable|string',
            'ccaaModal' => 'nullable|string',
            'provinciaModal' => 'nullable|string',
            'municipio' => 'nullable|string',
            'codigoPostalModal' => 'nullable|string',
            'numeroModal' => 'nullable|integer',
            'pisoModal' => 'nullable|integer',
            'escaleraModal' => 'nullable|string',
            'puertaModal' => 'nullable|string',
            'tipoClienteModal' => 'required|in:AUTOS,SAT',
            'observacionesModal' => 'nullable|string',
        ]);

        // Actualizar los campos del cliente
        $cliente->nombre = $request->input('nombreModal');

        $cliente->codigo = $request->input('codigoModal');

        $cliente->nif = $request->input('nifModal');
        $cliente->email = $request->input('emailModal');
        $cliente->movil = $request->input('movilModal');
        $cliente->fax = $request->input('faxModal');
        $cliente->telefono = $request->input('telefonoModal');

        $cliente->pais = $request->input('paisModal');
        $cliente->ccaa = $request->input('ccaaModal');
        $cliente->provincia = $request->input('provinciaModal');
        $cliente->municipio = $request->input('municipio');
        $cliente->domicilio = $request->input('domicilioModal');

        $cliente->tipoCliente = $request->input('tipoClienteModal');

        $cliente->escalera = $request->input('escaleraModal');
        $cliente->puerta = $request->input('puertaModal');
        $cliente->piso = $request->input('pisoModal');
        $cliente->numero = $request->input('numeroModal');
        $cliente->codigoPostal = $request->input('codigoPostalModal');

        $cliente->observaciones = $request->input('observacionesModal');

        if (!$cliente->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error el cliente en la base de datos. Por favor, inténtalo de nuevo.');
        }

        // Obtener las marcas seleccionadas del formulario
        $marcasSeleccionadas = $request->input('marcas', []);

        // Actualizar la relación entre el cliente y las marcas
        $cliente->marcas()->sync($marcasSeleccionadas);

        return redirect()->route('clientes')->with('success', 'El cliente '.$cliente->nombre.' se ha editado correctamente');
    }

    public function marcas(Request $request, $id)
    {
        $cliente = Cliente::find($id);
    
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }
    
        $marcas = $cliente->marcas;
    
        return response()->json($marcas);
    }

}