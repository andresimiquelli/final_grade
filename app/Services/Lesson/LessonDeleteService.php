<?php

namespace App\Services\Lesson;

use App\Models\Lesson;
use App\Services\DeleteService;

class LessonDeleteService extends DeleteService
{
    protected $model = Lesson::class;
}