<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'marcas';

    protected $fillable = [
        'id',
        'nombre',
    ];

    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'clientesMarcas', 'idMarca', 'idCliente');
    }
    
}