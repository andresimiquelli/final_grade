<?php

namespace App\Services\Subject;

use App\Models\Subject;
use App\Services\PostService;

class SubjectPostService extends PostService
{
    protected $model = Subject::class;
}