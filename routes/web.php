<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Incidencia;
use App\Models\Departamento;
use App\Models\Marca;
use App\Models\CCAA;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Prioridad;
use App\Models\Estado;
use App\Models\Pais;
use App\Models\Area;
use App\Models\Facturacion;

use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\IncidenciaLineaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// INCIDENCIAS

Route::get('/incidencias/{id}/areas', [IncidenciaController::class, 'areas'])->name('incidencias.areas');

Route::post('/incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');

Route::get('/incidencia/download/{id}', [IncidenciaController::class, 'download'])->name('incidencia.download');

Route::get('/incidencias/{id}', [IncidenciaController::class, 'getIncidencia'])->name('incidencia.getIncidencia');

// INCIDENCIAS LINEAS

Route::post('/incidenciaLinea', [IncidenciaLineaController::class, 'store'])->name('incidenciaLinea.store');

Route::get('/incidenciaLinea/{idIncidencia}', [IncidenciaLineaController::class, 'getIncidenciaLineas'])->name('incidenciaLinea.getIncidenciaLineas');

Route::get('/incidenciaLinea/download/{id}', [IncidenciaLineaController::class, 'download'])->name('incidenciaLinea.download');

// MARCAS

Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');

Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');

Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');

// ESTADOS

Route::post('/estados', [EstadoController::class, 'store'])->name('estados.store');

Route::put('/estados/{estado}', [EstadoController::class, 'update'])->name('estados.update');

// DEPARTAMENTOS

Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');

Route::put('/departamentos/{departamento}', [DepartamentoController::class, 'update'])->name('departamentos.update');

Route::delete('/departamentos/{departamento}', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');

// EMPLEADOS

Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');

Route::put('/empleados/update/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');

Route::get('/empleados/index/{idCliente}', [EmpleadoController::class, 'index'])->name('empleados.index');

Route::get('/empleados/{id}', [EmpleadoController::class, 'getEmpleadoById'])->name('empleados.getEmpleadoById');

Route::get('/empleados/cliente/{idCliente}', [EmpleadoController::class, 'getEmpleadosCliente'])->name('empleados.getEmpleadosCliente');

// ESTADOS

Route::get('/estados/{id}', [EstadoController::class, 'getEstadoById'])->name('estados.getEstadoById');

// USUARIOS

Route::get('/usuarios/{id}', [UserController::class, 'getUser'])->name('usuarios.getUser');

Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

Route::post('/usuarios/update-password', [UserController::class, 'updatePassword'])->name('usuarios.updatePassword');

Route::post('/usuarios/update-password2', [UserController::class, 'updatePassword2'])->name('usuarios.updatePassword2');

Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

// DEPARTAMENTOS

Route::get('/departamentos/{id}', [DepartamentoController::class, 'getDepartamentoById'])->name('departamentos.getDepartamentoById');

// PRIORIDAD

Route::get('/prioridades/{id}', [PrioridadController::class, 'getPrioridadById'])->name('prioridadades.getPrioridadById');

// CLIENTES

Route::get('/clientes/{id}', [ClienteController::class, 'getClienteById'])->name('clientes.getClienteById');

Route::get('/clientes/{id}/marcas', [ClienteController::class, 'marcas'])->name('clientes.marcas');

Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

Route::post('/clientes/buscar', function (Illuminate\Http\Request $request) {
    try {
        $search = $request->input('search.value');
        $column_order = $request->input('order.0.column', 'asc');

        $column_name = '';
        switch ($column_order) {
            case 0:
                $column_name = 'id';
                break;
            case 1:
                $column_name = 'nombre';
                break;
            default:
                $column_name = 'id';
                break;
        }
        $order_dir = $request->input('order.0.dir');

        $clientes = Cliente::where('nombre', 'LIKE', '%'.$search.'%')
                        ->orWhere('id', 'LIKE', '%'.$search.'%')
                        ->orderBy($column_name, $order_dir)
                        ->offset($request->input('start'))
                        ->limit($request->input('length'))
                        ->get();
                        
        $recordsTotal = Cliente::count();

        $recordsFiltered = Cliente::where('nombre', 'LIKE', '%'.$search.'%')
                        ->orWhere('id', 'LIKE', '%'.$search.'%')
                        ->count();
                        
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $clientes
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
})->name('clientes.buscar');


// VISTAS

Route::get('/clientes', function (Illuminate\Http\Request $request) {
    $clientes = Cliente::orderBy('nombre', 'asc')->get();
    $currentRoute = $request->path();
    $ccaas = CCAA::orderBy('Nombre', 'asc')->get();
    $municipios = Municipio::orderBy('Municipio', 'asc')->get();
    $provincias = Provincia::orderBy('Provincia', 'asc')->get();
    $marcas = Marca::orderBy('nombre', 'asc')->get();
    $paises = Pais::orderBy('nombre', 'asc')->get();
    return view('clientes', ['marcas' => $marcas, 'clientes' => $clientes, 'paises' => $paises, 'ccaas' => $ccaas, 'municipios' => $municipios, 'provincias' => $provincias, 'currentRoute' => $currentRoute]);
})->name('clientes');

Route::get('/incidencias', function (Illuminate\Http\Request $request) {
    $clientes = Cliente::all();
    $incidencias = Incidencia::all();
    $departamentos = Departamento::all();
    $estados = Estado::all();
    $prioridades = Prioridad::all();
    $marcas = Estado::all();
    $areas = Area::all();
    $facturaciones = Facturacion::all();
    $estados = Estado::all();
    $currentRoute = $request->path();
    return view('incidencias', ['estados' => $estados, 'areas' => $areas, 'facturaciones' => $facturaciones, 'prioridades' => $prioridades, 'estados' => $estados, 'clientes' => $clientes, 'incidencias' => $incidencias, 'departamentos' => $departamentos, 'currentRoute' => $currentRoute]);
})->name('incidencias');

Route::get('/marcas', function (Illuminate\Http\Request $request) {
    $marcas = Marca::orderBy('nombre', 'asc')->get();
    $currentRoute = $request->path();
    return view('marcas', ['marcas' => $marcas, 'currentRoute' => $currentRoute]);
})->name('marcas');

Route::get('/departamentos', function (Illuminate\Http\Request $request) {
    $departamentos = Departamento::orderBy('nombre', 'asc')->get();
    $currentRoute = $request->path();
    return view('departamentos', ['departamentos' => $departamentos, 'currentRoute' => $currentRoute]);
})->name('departamentos');

Route::get('/usuarios', function (Illuminate\Http\Request $request) {
    $usuarios = User::orderBy('name', 'asc')->get();
    $currentRoute = $request->path();
    return view('usuarios', ['usuarios' => $usuarios, 'currentRoute' => $currentRoute]);
})->name('usuarios');

Route::get('/estados', function (Illuminate\Http\Request $request) {
    $estados = Estado::all();
    $currentRoute = $request->path();
    return view('estados', ['estados' => $estados, 'currentRoute' => $currentRoute]);
})->name('estados');

// LOGIN
Route::get('/', function () {
    return view('auth.login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// PASSWORD

Route::get('/showRecoverPassword', [ResetPasswordController::class, 'showRecoverPassword'])->name('showRecoverPassword');

Route::post('/showRecoverPassword', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');



//AUTENTICACIÓN
Route::post('/login', function(Request $request) {

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        // Si las credenciales son correctas, redirigir al usuario
        return redirect()->route('incidencias');

    } else {

        // Si las credenciales son incorrectas, redirigir al usuario de vuelta a la página de inicio de sesión con un mensaje de error
        return redirect()->back()->withErrors(['error' => 'Datos de inicio de sesión incorrectos.']);

    }
});