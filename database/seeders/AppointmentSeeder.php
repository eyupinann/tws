<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('appointments')->insert([
            [
                "user_id" => 1,
                "doctor_id" => 1,
                "clinic_id" => 1,
                "treatment_id" => 1,
                "appointment_time" => '25.06.2023'
            ],
            [
                "user_id" => 2,
                "doctor_id" => 2,
                "clinic_id" => 2,
                "treatment_id" => 2,
                "appointment_time" => '25.06.2023'
            ]
        ]);
    }
}
