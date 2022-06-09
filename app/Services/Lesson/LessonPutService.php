<?php

namespace App\Services\Lesson;

use App\Models\Lesson;
use App\Services\PutService;

class LessonPutService extends PutService
{
    protected $model = Lesson::class;
}