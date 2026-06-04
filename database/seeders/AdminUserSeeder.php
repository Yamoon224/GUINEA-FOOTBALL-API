<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@guinee-football.local'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin1234'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
