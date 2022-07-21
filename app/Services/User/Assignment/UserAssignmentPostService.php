<?php

namespace App\Services\User\Assignment;

use App\Models\UserAssignment;
use App\Services\PostService;

class UserAssignmentPostService extends PostService
{
    protected $model = UserAssignment::class;
}