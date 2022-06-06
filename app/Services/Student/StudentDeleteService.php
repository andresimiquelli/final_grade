<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\DeleteService;

class StudentDeleteService extends DeleteService
{
    protected $model = Student::class;
}