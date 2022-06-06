<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\PutService;

class StudentPutService extends PutService
{
    protected $model = Student::class;
}