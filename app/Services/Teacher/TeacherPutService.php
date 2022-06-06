<?php

namespace App\Services\Teacher;

use App\Models\Teacher;
use App\Services\PutService;

class TeacherPutService extends PutService
{
    protected $model = Teacher::class;
}