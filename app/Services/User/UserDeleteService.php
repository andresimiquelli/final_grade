<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\DeleteService;

class UserDeleteService extends DeleteService
{
    protected $model = User::class;
}