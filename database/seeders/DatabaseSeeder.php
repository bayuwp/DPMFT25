<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk akun jurusan
        $this->call([
            PPLFTUsersSeeder::class,
        ]);

        // Tambahkan akun admin secara manual
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Ganti password sesuai kebutuhan
            ]
        );
    }
}
