<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Leonardo',
            'email' => 'ej1@ej.com',
            'password' => Hash::make('12345678'),
            'pageweb' => 'http://codigo.com',
        ]);


        $user2 = User::create([
            'name' => 'Hector',
            'email' => 'ej2@ej.com',
            'password' => Hash::make('12345678'),
            'pageweb' => 'http://codigo.com',
        ]);


        $user3 = User::create([
            'name' => 'Matias',
            'email' => 'ej3@ej.com',
            'password' => Hash::make('12345678'),
            'pageweb' => 'http://codigo.com',
        ]);
    }
}
