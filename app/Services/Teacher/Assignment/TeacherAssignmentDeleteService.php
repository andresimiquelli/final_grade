<?php

namespace App\Services\Teacher\Assignment;

use App\Models\TeacherAssignment;
use App\Services\DeleteService;

class TeacherAssignmentDeleteService extends DeleteService
{
    protected $model = TeacherAssignment::class;
}