<?php

namespace App\Services\Evaluation\Grade;

use App\Models\EvaluationGrade;
use App\Services\DeleteService;

class EvaluationGradeDeleteService extends DeleteService
{
    protected $model = EvaluationGrade::class;
}