<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clinics')->insert([
            [
                "name" => 'Medical Park',
                "opening_hour" => '06:00:00',
                "closing_hour" => '19:00:00',
            ],
            [
                "name" => 'Acıbadem',
                "opening_hour" => '06:00:00',
                "closing_hour" => '19:00:00',
            ]
        ]);
    }
}
