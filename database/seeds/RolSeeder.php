<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'nombre' => 'administrador',
        ]);
        Rol::create([
            'nombre' => 'contador',
        ]);
        Rol::create([
            'nombre' => 'supervisor',
        ]);
        Rol::create([
            'nombre' => 'cajero',
        ]);
        //
    }
}
