<?php

namespace App\Services\Enrollment\Absence;

use App\Models\EnrollmentAbsence;
use App\Services\PutService;

class EnrollmentAbsencePutService extends PutService
{
    protected $model = EnrollmentAbsence::class;
}