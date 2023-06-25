<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                "user_id" => 1,
                "clinic_id" => 1,
                "role_id" => 1,
            ],
            [
                "user_id" => 2,
                "clinic_id" => 2,
                "role_id" => 2,
            ]
        ]);
    }
}
