<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\PostService;

class CoursePostService extends PostService
{
    protected $model = Course::class;
}