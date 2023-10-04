<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidenciaLinea extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'incidenciasLineas';

    protected $hidden = [
        'archivo',
    ];

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'idIncidencia');
    }

    public $timestamps = false;
}