<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\GetService;

class StudentGetService extends GetService
{
    protected $model = Student::class;
    protected $searchable = [
        'name',
        'email',
        'created_at'
    ];
}