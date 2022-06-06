<?php

namespace App\Services\Enrollment;

use App\Models\Enrollment;
use App\Services\PostService;

class EnrollmentPostService extends PostService
{
    protected $model = Enrollment::class;
}