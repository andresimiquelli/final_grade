<?php

namespace App\Services\User\Assignment;

use App\Models\UserAssignment;
use App\Services\GetService;

class UserAssignmentGetService extends GetService
{
    protected $model = UserAssignment::class;
    protected $searchable = ['user_id'];

    protected $with_fields = ['teacher','cclass','class.pack','subject','subject.subject'];
}