<?php

use Illuminate\Database\Seeder;
use App\Equipo;
use App\Disciplina;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplinaId = Disciplina::where('nombre', 'Futbol 8')->value('id');
        Equipo::create([
            'nombre' => 'Anonymous',
            'descripcion' => 'El poder del Conocimiento',
            'disciplina_id' => $disciplinaId,
            'image' => 'https://cdn2.iconfinder.com/data/icons/heroes/128/superhero_captain_hero_comic-512.png',
            'visible' => true
        ]);
        Equipo::create([
            'nombre' => 'Donatoss',
            'descripcion' => 'Creando Delicias',
            'disciplina_id' => $disciplinaId,
            'image' => 'https://cdn2.iconfinder.com/data/icons/heroes/128/superhero_robin_comic_hero-512.png',
            'visible' => true
        ]);
        Equipo::create([
            'nombre' => 'Monkycoins',
            'descripcion' => 'Pensando en Grande',
            'disciplina_id' => $disciplinaId,
            'image' => 'https://cdn2.iconfinder.com/data/icons/heroes/128/superhero_batman_hero_comic-512.png',
            'visible' => true
        ]);
        Equipo::create([
            'nombre' => 'Cuentaseguro',
            'descripcion' => 'Buscamos tu Seguridad',
            'disciplina_id' => $disciplinaId,
            'image' => 'https://cdn2.iconfinder.com/data/icons/heroes/128/superhero_flash_hero_comic-512.png',
            'visible' => true
        ]);
        Equipo::create([
            'nombre' => 'Designerstyle',
            'descripcion' => 'Ideas hechas Arte',
            'disciplina_id' => $disciplinaId,
            'image' => 'https://cdn2.iconfinder.com/data/icons/heroes/128/superhero_ironman_comic_hero-512.png',
            'visible' => true
        ]);
    }
}
