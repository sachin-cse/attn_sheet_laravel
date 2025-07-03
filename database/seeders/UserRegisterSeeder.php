<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users_data = [
            [
                'first_name' => 'Hardik',
                'last_name' => 'Pandya',
                'email' => 'admin@gmail.com',
                'password' => 12345678
            ],
            [
                'first_name' => 'Sachin',
                'last_name' => 'Mandal',
                'email' => 'mandalsachin725@gmail.com',
                'password' => 12345678
            ],
            [
                'first_name' => 'Subhadip',
                'last_name' => 'Pal',
                'email' => 'subhadip517@gmail.com',
                'password' => 12345678
            ]
        ];

        foreach($users_data as $user){
            User::create($user);
        }
    }
}
