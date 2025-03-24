<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TipoSangre;

class TipoSangreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoSangre::create(['descripcion' => 'A+']);
        TipoSangre::create(['descripcion' => 'A-']);
        TipoSangre::create(['descripcion' => 'B+']);
        TipoSangre::create(['descripcion' => 'B-']);
        TipoSangre::create(['descripcion' => 'AB+']);
        TipoSangre::create(['descripcion' => 'AB-']);
        TipoSangre::create(['descripcion' => 'O+']);
        TipoSangre::create(['descripcion' => 'O-']);
    }
}
