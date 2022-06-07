<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\GetService;

class UserGetService extends GetService
{
    protected $model = User::class;
    protected $searchable = [
        'name',
        'email',
        'type',
        'status'
    ];
}