<?php

namespace App\Services\Teacher\Assignment;

use App\Models\TeacherAssignment;
use App\Services\GetService;

class TeacherAssignmentGetService extends GetService
{
    protected $model = TeacherAssignment::class;
    protected $searchable = ['user_id'];

    protected $with_fields = ['teacher','teacher.user','cclass','class.pack','subject'];
}