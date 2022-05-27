<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\PutService;

class CoursePutService extends PutService
{
    protected $model = Course::class;
}