<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'sandy',
                'email' => 'sandy@admin.com',
                'password' => '123',
                'role' => 'admin'
            ],
            [
                'name' => 'azhi',
                'email' => 'azhi@mail.com',
                'password' => '123',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        };
    }
}
