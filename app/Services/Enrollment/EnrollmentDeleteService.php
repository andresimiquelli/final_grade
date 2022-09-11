<?php

namespace App\Services\Enrollment;

use App\Exceptions\DeletionException;
use App\Models\Enrollment;
use App\Models\EnrollmentAbsence;
use App\Models\EvaluationGrade;
use App\Models\Finalgrade;
use App\Services\DeleteService;

class EnrollmentDeleteService extends DeleteService
{
    protected $model = Enrollment::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $finalgrades = Finalgrade::where('enrollment_id',$obj->id)->count();
        $evaluationGrades = EvaluationGrade::where('enrollment_id',$obj->id)->count();
        $absences = EnrollmentAbsence::where('enrollment_id',$obj->id)->count();

        if(($finalgrades+$evaluationGrades+$absences) > 0)
            throw new DeletionException(['finalgrades' => $finalgrades, 'evaluation_grages' => $evaluationGrades, 'enrollment_absences' => $absences]);

        return $obj;
    }
}
