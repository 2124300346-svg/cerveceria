<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        Administrador::create([
            'nombre' => 'Administrador Principal',
            'usuario' => 'admin',
            'contrasena' => Hash::make('admin123'),
            'activo' => 1
        ]);
    }
}