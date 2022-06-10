<?php

namespace App\Services\Enrollment\Absence;

use App\Models\EnrollmentAbsence;
use App\Services\PostService;

class EnrollmentAbsencePostService extends PostService
{
    protected $model = EnrollmentAbsence::class;
    protected $unique_fields = ['enrollment_id','lesson_id'];
    protected $update_if_exists = false;
}