<?php

namespace App\Services\Teacher;

use App\Models\Teacher;
use App\Services\PostService;

class TeacherPostService extends PostService
{
    protected $model = Teacher::class;
}