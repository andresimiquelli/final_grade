<?php

namespace App\Services\Teacher;

use App\Events\UserBeforeDelete;
use App\Models\Teacher;
use App\Services\DeleteService;

class TeacherDeleteService extends DeleteService
{
    protected $model = Teacher::class;
    protected $dispatchBeforeDelete = UserBeforeDelete::class;
}