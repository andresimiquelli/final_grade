<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\PostService;

class UserPostService extends PostService
{
    protected $model = User::class;
}