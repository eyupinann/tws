<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository;
use App\Models\Doctor;

class DoctorRepository extends BaseRepository
{
    public function __construct(Doctor $model = null)
    {
        if ($model === null) {
            $model = new Doctor();
        }

        parent::__construct($model);
    }

}
