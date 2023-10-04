<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'prioridad';

    protected $fillable = [
        'id',
        'nombre'
    ];

    public $timestamps = false;
}