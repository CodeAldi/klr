<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Super Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('12345678'),
                'role' => UserRole::admin,
            ]
        );
        User::create(
            [
                'name' => 'mahasiswa 1',
                'email' => 'mahasiswa@test.com',
                'password' => bcrypt('12345678'),
                'role' => UserRole::peminjam,
            ]
        );
        User::create(
            [
                'name' => 'teknisi labor 1',
                'email' => 'teknisi@test.com',
                'password' => bcrypt('12345678'),
                'role' => UserRole::teknisi,
            ]
        );
        User::create(
            [
                'name' => 'kepala labor 1',
                'email' => 'kalab@test.com',
                'password' => bcrypt('12345678'),
                'role' => UserRole::kepala,
            ]
        );
    }
}
