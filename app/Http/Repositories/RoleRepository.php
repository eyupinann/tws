<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model = null)
    {
        if ($model === null) {
            $model = new Role();
        }

        parent::__construct($model);
    }

}
