<?php

namespace App\Services\Enrollment;

use App\Models\Enrollment;
use App\Services\DeleteService;

class EnrollmentDeleteService extends DeleteService
{
    protected $model = Enrollment::class;
}