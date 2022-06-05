<?php

namespace App\Services\Subject;

use App\Models\Subject;
use App\Services\PutService;

class SubjectPutService extends PutService
{
    protected $model = Subject::class;
}