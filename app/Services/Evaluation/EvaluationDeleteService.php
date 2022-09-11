<?php

namespace App\Services\Evaluation;

use App\Exceptions\DeletionException;
use App\Models\Evaluation;
use App\Models\EvaluationGrade;
use App\Services\DeleteService;

class EvaluationDeleteService extends DeleteService
{
    protected $model = Evaluation::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $evaluationGrades = EvaluationGrade::where('evaluation_id',$obj->id)->count();

        if($evaluationGrades > 0)
            throw new DeletionException([ 'evaluation_grages' => $evaluationGrades]);

        return $obj;
    }
}
