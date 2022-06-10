<?php

namespace App\Services\Enrollment\Absence;

use App\Models\EnrollmentAbsence;
use App\Services\DeleteService;

class EnrollmentAbsenceDeleteService extends DeleteService
{
    protected $model = EnrollmentAbsence::class;
}