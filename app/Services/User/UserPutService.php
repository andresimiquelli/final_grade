<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\PutService;

class UserPutService extends PutService
{
    protected $model = User::class;
}