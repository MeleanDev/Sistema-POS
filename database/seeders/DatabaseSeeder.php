<?php

namespace Database\Seeders;

use App\Models\EmpresaDato;
use App\Models\MesCantidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12121212')
        ]);

        EmpresaDato::create([
            'foto' => '',
            'nempresa' => '',
            'rif' => '',
            'rsocial' => '',
            'correo' => '',
            'telefono' => '',
            'direccion' => '',
            'pais' => '',
            'estado' => '',
            'ciudad' => '',
            'cpostal' => '',
        ]);

        $data = [
            array('mes' => 'Enero', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Febrero', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Marzo', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Abril', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Mayo', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Junio', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Julio', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Agosto', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Septiembre', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Octubre', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Noviembre', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
            array('mes' => 'Diciembre', 'cantidadesBS' => 0, 'cantidadesDolar' => 0, 'cantidadeTotal' => 0, 'compras' => 0),
        ];

        MesCantidad::insert($data);
        
    }
}
