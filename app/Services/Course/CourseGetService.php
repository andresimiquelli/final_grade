<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\GetService;

class CourseGetService extends GetService
{
    protected $model = Course::class;
    protected $searchable = [
        'name',
        'level'
    ];
}