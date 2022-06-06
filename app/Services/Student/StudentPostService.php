<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\PostService;

class StudentPostService extends PostService
{
    protected $model = Student::class;
}