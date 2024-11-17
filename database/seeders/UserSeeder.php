<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'danny',
                'email' => 'admin@danny.com',
                'username' => 'dewise',
                'password' => Hash::make('Danny@178'),
                'mobile' => '1234567890',
                'country' => 'Country',
                'role' => 'admin',
                'status' => 'verified',
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'username' => 'johndoe',
                'password' => Hash::make('password'),
                'mobile' => '0987654321',
                'country' => 'Country',
                'role' => 'user',
                'status' => 'unverified',
            ],
            // Add more users as needed
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
