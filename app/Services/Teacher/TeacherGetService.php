<?php

namespace App\Services\Teacher;

use App\Models\Teacher;
use App\Services\GetService;

class TeacherGetService extends GetService
{
    protected $model = Teacher::class;
    protected $searchable = [
        'user_id'
    ];

    protected $with_fields = [
        'user'
    ];
}