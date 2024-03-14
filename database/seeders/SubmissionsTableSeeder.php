<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run()
    {
        DB::table('submissions')->insert([
            'deadline' => '2024-05-31',
        ]);
    }

}
