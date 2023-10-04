<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'incidencias';

    protected $fillable = [
        'fechaCreacion',
        'fechaActualizacion',
        'titulo',
    ];

    protected $hidden = [
        'archivo',
    ];

    public $timestamps = false;

    public function incidenciaLineas()
    {
        return $this->hasMany(IncidenciaLinea::class, 'idIncidencia');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado');
    }
    
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'idPrioridad');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'idDepartamento');
    }
    
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado')->withDefault([
            'nombre' => '',
        ]);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'incidenciaAreas', 'idIncidencia', 'idArea');
    }
    
}