<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'firstName' => 'Guilherme',
                'lastName' => 'Baltazar',
                'email' => 'guibaltazarvs2@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'firstName' => 'Natã',
                'lastName' => 'Coimbra',
                'email' => 'nata@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
