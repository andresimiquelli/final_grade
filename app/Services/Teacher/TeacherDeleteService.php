<?php

namespace App\Services\Teacher;

use App\Models\Teacher;
use App\Services\DeleteService;

class TeacherDeleteService extends DeleteService
{
    protected $model = Teacher::class;
}