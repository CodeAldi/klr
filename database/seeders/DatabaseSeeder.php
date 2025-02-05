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
    }
}
