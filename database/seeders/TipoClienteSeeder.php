<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoCliente;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCliente::create(['descripcion' => 'Comun']);
        TipoCliente::create(['descripcion' => 'Empresarial']);
        TipoCliente::create(['descripcion' => 'Exclusivo']);
    }
}
