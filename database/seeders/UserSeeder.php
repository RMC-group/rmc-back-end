<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => '1',
            'role' => 'admin',
            'first_name' => 'piyumal',
            'last_name' => 'nipuna',
            'user_name' => 'piyumal',
            'email' => 'piyumal@gmail.com',
            'password' => Hash::make('1234')
        ]);
    }
}
