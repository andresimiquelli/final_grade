<?php

namespace App\Services\Enrollment;

use App\Models\Enrollment;
use App\Services\PutService;

class EnrollmentPutService extends PutService
{
    protected $model = Enrollment::class;
}