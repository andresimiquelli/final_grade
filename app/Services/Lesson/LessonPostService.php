<?php

namespace App\Services\Lesson;

use App\Models\Lesson;
use App\Services\PostService;

class LessonPostService extends PostService
{
    protected $model = Lesson::class;
}