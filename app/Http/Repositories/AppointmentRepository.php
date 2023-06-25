<?php

namespace App\Http\Repositories;

use App\Models\Appointment;
use App\Http\Repositories\BaseRepository;

class AppointmentRepository extends BaseRepository
{
    public function __construct(Appointment $model = null)
    {
        if ($model === null) {
            $model = new Appointment();
        }

        parent::__construct($model);
    }

}
