<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $model = null)
    {
        if ($model === null) {
            $model = new User();
        }

        parent::__construct($model);
    }

}
