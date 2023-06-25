<?php

namespace App\Http\Repositories;

use App\Models\Clinic;
use App\Http\Repositories\BaseRepository;

class ClinicRepository extends BaseRepository
{
    public function __construct(Clinic $model = null)
    {
        if ($model === null) {
            $model = new Clinic();
        }

        parent::__construct($model);
    }

}
