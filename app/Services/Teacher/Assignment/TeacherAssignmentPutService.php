<?php

namespace App\Services\Teacher\Assignment;

use App\Models\TeacherAssignment;
use App\Services\PutService;

class TeacherAssignmentPutService extends PutService
{
    protected $model = TeacherAssignment::class;
}