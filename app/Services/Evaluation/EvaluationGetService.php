<?php

namespace App\Services\Evaluation;

use App\Models\Evaluation;
use App\Services\GetService;

class EvaluationGetService extends GetService
{
    protected $model = Evaluation::class;
    protected $searchable = [
        'name',
        'value',
        'created_at',
        'teacher_id',
        'class_id',
        'pack_module_subject_id'
    ];
}