<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    public $incrementing = true;
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'puesto',
        'nombre_usuario',
        'direccion',
        'telefono',
        'correo',
        'rfc',
        'contrasena',
        'fecha_Nac',
        'num_ss',
        'estado',
        'img1_usuario'
    ];

    public $timestamps = false;
}