<?php

namespace App\Http\Repositories;

use App\Models\Offer;
use App\Http\Repositories\BaseRepository;

class OfferRepository extends BaseRepository
{
    public function __construct(Offer $model = null)
    {
        if ($model === null) {
            $model = new Offer();
        }

        parent::__construct($model);
    }

}
