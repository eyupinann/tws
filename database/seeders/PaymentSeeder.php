<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                "amount" => 1,
                "user_id" => 1,
                "status" => 'Success',
            ],
            [
                "amount" => 2,
                "user_id" => 2,
                "status" => 'Success',
            ]
        ]);
    }
}
