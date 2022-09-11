<?php

namespace App\Services\Lesson;

use App\Exceptions\DeletionException;
use App\Models\EnrollmentAbsence;
use App\Models\Lesson;
use App\Services\DeleteService;

class LessonDeleteService extends DeleteService
{
    protected $model = Lesson::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $absences = EnrollmentAbsence::where('lesson_id',$obj->id)->count();

        if($absences > 0)
            throw new DeletionException([ 'enrollment_absences' => $absences]);

        return $obj;
    }
}
