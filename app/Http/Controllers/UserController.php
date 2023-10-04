<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getUserById($id)
    {
        // Obtener el usuario por ID
        $user = User::find($id);

        // Verificar si el usuario existe
        if ($user) {
            // Retornar una respuesta JSON con el usuario
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } else {
            // Retornar una respuesta de error en caso de que el usuario no exista
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }

    }

    public function store(Request $request)
    {
        // Validar los datos enviados en el formulario
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'movil' => 'nullable|integer',
            'codigo' => 'nullable|integer'
        ]);
    
        // Crear un nuevo objeto User con los datos del formulario
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->movil = $request->movil;
        $user->codigo = $request->codigo;
    
        $hashedPassword = Hash::make($request->password); // contraseña con hash
        $user->password = $hashedPassword; // Se encripta la contraseña antes de almacenarla
    
        // Guardar el nuevo usuario en la base de datos
        $user->save();
    
        // Redireccionar a la página de éxito o mostrar un mensaje de éxito
        return redirect()->route('usuarios')->with('success', 'Usuario creado exitosamente.');
    }    
    
        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'movil' => 'nullable|integer',
            'codigo' => 'nullable|integer'
        ]);
    
        // Obtener el usuario existente por su ID
        $user = User::findOrFail($id);
    
        // Verificar si el correo electrónico es diferente al actual
        if ($request->email !== $user->email) {
            // Verificar si existe otro usuario con el mismo correo electrónico
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'El correo electrónico ya está en uso por otro usuario.');
            }
        }
    
        // Actualizar los campos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->movil = $request->movil;
        $user->codigo = $request->codigo;
    
        if (!$user->save()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al actualizar el usuario en la base de datos. Por favor, inténtalo de nuevo.');
        }
    
        return redirect()->route('usuarios')->with('success', 'El usuario '.$user->name.' se ha editado correctamente');
    }      
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Eliminar el usuario
        if (!$user->delete()) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al eliminar el usuario. Por favor, inténtalo de nuevo.');
        }

        return redirect()->route('usuarios')->with('success', 'El usuario '.$user->name.' se ha eliminado correctamente');
    }

    public function getUser($id) {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        return response()->json($user);
    }

    public function updatePassword(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Verificar si la contraseña actual es válida
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['warning' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
    }


    public function updatePassword2(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'new_password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Buscar al usuario con la dirección de correo electrónico específica
        //$user = User::where('email', 'k.talasimov@ack.es')->first();

        // Actualizar la contraseña del usuario
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
    }


}