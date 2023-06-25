<?php

namespace App\Http\Repositories;

use App\Models\Treatment;
use App\Http\Repositories\BaseRepository;

class TreatmentRepository extends BaseRepository
{
    public function __construct(Treatment $model = null)
    {
        if ($model === null) {
            $model = new Treatment();
        }

        parent::__construct($model);
    }

}
