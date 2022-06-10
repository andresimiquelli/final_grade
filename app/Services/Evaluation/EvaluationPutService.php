<?php

namespace App\Services\Evaluation;

use App\Models\Evaluation;
use App\Services\PutService;

class EvaluationPutService extends PutService
{
    protected $model = Evaluation::class;
}