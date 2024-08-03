<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaDato extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nempresa',
        'rif',
        'rsocial',
        'correo',
        'telefono',
        'direccion',
        'pais',
        'estado',
        'ciudad',
        'cpostal',
        'foto'
    ];
}
