<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'             => Str::uuid(),
                'name'           => 'Admin',
                'email'          => 'admin@gmail.com',
                'password'       => Hash::make('123456'),
            ],
            [
                'id'             => Str::uuid(),
                'name'           => 'Test',
                'email'          => 'test@gmail.com',
                'password'       => Hash::make('123456'),
            ],[
                'id'             => Str::uuid(),
                'name'           => 'Demo',
                'email'          => 'demo@gmail.com',
                'password'       => Hash::make('123456'),
            ]
        ];

        User::insert($users);
    }
}
