<?php

namespace App\Services\Evaluation\Grade;

use App\Models\EvaluationGrade;
use App\Services\PostService;

class EvaluationGradePostService extends PostService
{
    protected $model = EvaluationGrade::class;
    protected $unique_fields = ['evaluation_id','enrollment_id'];
}