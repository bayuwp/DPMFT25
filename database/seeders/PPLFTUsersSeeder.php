<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PPLFTUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Teknik Mesin', 'email' => 'teknik.mesin@ft.unesa.ac.id', 'password' => 'mesin123'],
            ['name' => 'Pendidikan Teknik Mesin', 'email' => 'pendidikan.teknik.mesin@ft.unesa.ac.id', 'password' => 'penmesin123'],
            ['name' => 'Pendidikan Tata Boga', 'email' => 'pendidikan.tata.boga@ft.unesa.ac.id', 'password' => 'boga123'],
            ['name' => 'Pendidikan Tata Busana', 'email' => 'pendidikan.tata.busana@ft.unesa.ac.id', 'password' => 'busana123'],
            ['name' => 'Pendidikan Tata Rias', 'email' => 'pendidikan.tata.rias@ft.unesa.ac.id', 'password' => 'rias123'],
            ['name' => 'Teknik Informatika', 'email' => 'informatika@ft.unesa.ac.id', 'password' => 'informatika123'],
            ['name' => 'Pendidikan Teknik Informatika', 'email' => 'pendidikan.teknik.informatika@ft.unesa.ac.id', 'password' => 'pendinformatika123'],
            ['name' => 'Sistem Informasi', 'email' => 'sistem.informasi@ft.unesa.ac.id', 'password' => 'si123'],
            ['name' => 'Teknik Elektro', 'email' => 'elektro@ft.unesa.ac.id', 'password' => 'elektro123'],
            ['name' => 'Pendidikan Teknik Elektro', 'email' => 'pendidikan.teknik.elektro@ft.unesa.ac.id', 'password' => 'pendelektro123'],
            ['name' => 'Teknik Sipil', 'email' => 'sipil@ft.unesa.ac.id', 'password' => 'sipil123'],
            ['name' => 'Pendidikan Teknik Bangunan', 'email' => 'pendidikan.teknik.bangunan@ft.unesa.ac.id', 'password' => 'bangunan123'],
            ['name' => 'PWK', 'email' => 'pwk@ft.unesa.ac.id', 'password' => 'pwk123'],
            ['name' => 'BEM', 'email' => 'bem@ft.unesa.ac.id', 'password' => 'bem123'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                ]
            );
        }
    }
}
