<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'foto',
        'codigo',
        'nombre',
        'descripcion',
        'categoria',
        'proveedor',
        'cantidad',
        'precio',
        'vendidos'
    ];
}
