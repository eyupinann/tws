<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('clinic_id');
            $table->bigInteger('treatment_id');
            $table->date('appointment_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('doctor_id');
            $table->dropColumn('clinic_id');
            $table->dropColumn('treatment_id');
            $table->dropColumn('appointment_time');
        });
    }
};
