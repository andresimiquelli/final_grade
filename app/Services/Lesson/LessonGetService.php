<?php

namespace App\Services\Lesson;

use App\Models\Lesson;
use App\Services\GetService;

class LessonGetService extends GetService
{
    protected $model = Lesson::class;
    protected $searchable = [
        'reference',
        'class_id'
    ];

    protected $with_fields = [
        'absences',
        'teacher'
    ];
}