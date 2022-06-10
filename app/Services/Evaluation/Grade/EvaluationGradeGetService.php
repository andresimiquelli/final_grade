<?php

namespace App\Services\Evaluation\Grade;

use App\Models\EvaluationGrade;
use App\Services\GetService;

class EvaluationGradeGetService extends GetService
{
    protected $model = EvaluationGrade::class;
}