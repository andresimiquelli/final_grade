<?php

namespace App\Services\Enrollment;

use App\Models\Enrollment;
use App\Services\GetService;

class EnrollmentGetService extends GetService
{
    protected $model = Enrollment::class;
    protected $searchable = [
        'student_id',
        'class_id',
        'start_at',
        'end_at',
        'created_at',
        'status'
    ];

    protected $with_fields = [
        'student',
        'cclass'
    ];
}