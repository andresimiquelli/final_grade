<?php

namespace App\Services\Subject;

use App\Models\Subject;
use App\Services\GetService;

class SubjectGetService extends GetService
{
    protected $model = Subject::class;
    protected $searchable = [
        'name'
    ];
}