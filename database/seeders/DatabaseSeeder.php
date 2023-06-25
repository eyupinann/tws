<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AppointmentSeeder::class,
            ClinicSeeder::class,
            DoctorSeeder::class,
            PaymentSeeder::class,
            RoleSeeder::class,
            TreatmentSeeder::class,
        ]);
    }
}
