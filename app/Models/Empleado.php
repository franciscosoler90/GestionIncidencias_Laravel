<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'empleados';

    protected $fillable = [
        'idCliente',
        'nombre',
        'cargo',
        'telefonoFijo',
        'telefonoMovil',
        'correoEmpresa',
        'correoPersonal'
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }
}