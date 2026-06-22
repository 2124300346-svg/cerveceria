<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'administradores';

    protected $primaryKey = 'id_administrador';

    protected $fillable = [
        'usuario',
        'contrasena',
        'nombre',
        'activo'
    ];

    protected $hidden = [
        'contrasena'
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}