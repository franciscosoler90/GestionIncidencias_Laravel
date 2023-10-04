<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'estados';

    protected $fillable = [
        'id',
        'nombre'
    ];

    public $timestamps = false;
}