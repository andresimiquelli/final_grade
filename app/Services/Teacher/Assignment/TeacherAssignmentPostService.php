<?php

namespace App\Services\Teacher\Assignment;

use App\Models\TeacherAssignment;
use App\Services\PostService;

class TeacherAssignmentPostService extends PostService
{
    protected $model = TeacherAssignment::class;
}