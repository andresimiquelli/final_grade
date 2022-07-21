<?php

namespace App\Services\User\Assignment;

use App\Models\UserAssignment;
use App\Services\PutService;

class UserAssignmentPutService extends PutService
{
    protected $model = UserAssignment::class;
}