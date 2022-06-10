<?php

namespace App\Services\Enrollment\Absence;

use App\Models\EnrollmentAbsence;
use App\Services\GetService;

class EnrollmentAbsenceGetService extends GetService
{
    protected $model = EnrollmentAbsence::class;
    protected $searchable = [
        'lesson_id'
    ];

    protected $with_fields = [
        'enrollment',
        'lesson'
    ];
}