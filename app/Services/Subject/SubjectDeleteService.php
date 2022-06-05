<?php

namespace App\Services\Subject;

use App\Models\Subject;
use App\Services\DeleteService;

class SubjectDeleteService extends DeleteService
{
    protected $model = Subject::class;
}