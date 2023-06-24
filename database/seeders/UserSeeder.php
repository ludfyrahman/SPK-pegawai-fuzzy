<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin2@har2.com',

            ],
            [
                'email' => 'avp2@har2.com',

            ],
            [
                'email' => 'spv@har2.com',

            ],
            [
                'email' => 'foremen@har2.com',

            ],
            [
                'email' => 'shop@har2.com',

            ],

        ];
        foreach ($users as $key => $user) {
            User::create([
                'name'     => $user['email'],
                'username'     => $user['email'],
                'email'     => $user['email'],
                'password' => Hash::make('Instrumen2'),
            ]);

        }

        User::create([
            'name'     => 'admin@admin.com',
            'username'     => 'admin@admin.com',
            'email'     => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name'     => 'admin@admin.com',
            'username'     => 'admin@admin.com',
            'email'     => 'ryan@admin.com',
            'password' => Hash::make('password'),
        ]);

    }
}
