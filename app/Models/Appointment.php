<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function clinic()
    {
        return $this->hasOne(Clinic::class, 'id', 'clinic_id');
    }

    public function treatment()
    {
        return $this->hasOne(Treatment::class, 'id', 'treatment_id');
    }
}
