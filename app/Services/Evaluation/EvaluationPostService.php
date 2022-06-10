<?php

namespace App\Services\Evaluation;

use App\Models\Evaluation;
use App\Services\PostService;

class EvaluationPostService extends PostService
{
    protected $model = Evaluation::class;
}