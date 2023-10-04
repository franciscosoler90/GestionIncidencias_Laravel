<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'clientes';
    public $timestamps = false;

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'idCliente');
    }

    public function marcas()
    {
        return $this->belongsToMany(Marca::class, 'clientesMarcas', 'idCliente', 'idMarca');
    }

}