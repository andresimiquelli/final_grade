<?php

namespace App\Services\Evaluation;

use App\Models\Evaluation;
use App\Services\DeleteService;

class EvaluationDeleteService extends DeleteService
{
    protected $model = Evaluation::class;
}