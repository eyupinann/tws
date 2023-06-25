<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Clinic\ClinicController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Treatment\TreatmentController;

//api routes
Route::group(['prefix'=>'v1'], function() {
    Route::post('register', [AuthController::class, 'create']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix'=>'v1','middleware' => ['auth:sanctum']], function () {
    //User Update
    Route::post('profile-edit', [AuthController::class, 'edit']);
    //User Destroy
    Route::get('destroy/{id}', [AuthController::class, 'destroy']);
    //User Detail
    Route::get('detail', [AuthController::class, 'detail']);

    //Role
    Route::resource('role', RoleController::class);
    //Appointment
    Route::resource('appointment', AppointmentController::class);
    //Clinic
    Route::resource('clinic', ClinicController::class);
    //Doctor
    Route::resource('doctor', DoctorController::class);
    //Payment
    Route::resource('payment', PaymentController::class);
    //Treatment
    Route::resource('treatment', TreatmentController::class);

});


