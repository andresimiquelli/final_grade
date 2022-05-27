<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\DeleteService;

class CourseDeleteService extends DeleteService
{
    protected $model = Course::class;
}