<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presentacion extends Model
{
    use HasFactory;

    protected $table = 'presentacion';
    protected $primaryKey = 'id_presentacion';
    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'nombre_presentacion',
        'cantidad_unitaria',
        'cantidad_caja',
        'precio_unidad',
        'precio_caja',
        'descripcion',
        'estado'
    ];
}
