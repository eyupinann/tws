<?php

namespace App\Http\Repositories;

use App\Models\Payment;
use App\Http\Repositories\BaseRepository;

class PaymentRepository extends BaseRepository
{
    public function __construct(Payment $model = null)
    {
        if ($model === null) {
            $model = new Payment();
        }

        parent::__construct($model);
    }

}
