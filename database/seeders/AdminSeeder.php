<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'full_name' => 'Admin Name',
            'email' => 'admin@example.com',
            'program' => 'Admin Program',
            'department' => 'Admin Department',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'matric_no' => 'admin matric',
        ]);
    }
}
