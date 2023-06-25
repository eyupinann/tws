<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function clinic()
    {
        return $this->hasOne(Clinic::class, 'id', 'clinic_id');
    }

    public function role()
    {
        return $this->hasOne(Clinic::class, 'id', 'role_id');
    }
}
