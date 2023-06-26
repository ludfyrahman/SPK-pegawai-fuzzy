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

        User::create([
            'name'     => 'admin@admin.com',
            'username'     => 'admin@admin.com',
            'email'     => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name'     => 'admin@admin.com',
            'username'     => 'admin@admin.com',
            'email'     => 'ludfi@admin.com',
            'password' => Hash::make('password'),
        ]);

    }
}
