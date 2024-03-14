<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('sessions')->insert([
            'name' => 'Session 1',
            'start_date' => '2024-01-01',
            'end_date' => '2024-06-30',
        ]);
    }
}
