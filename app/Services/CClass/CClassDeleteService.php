<?php

namespace App\Services\CClass;

use App\Exceptions\DeletionException;
use App\Models\CClass;
use App\Models\Enrollment;
use App\Models\Evaluation;
use App\Models\Journal;
use App\Models\Lesson;
use App\Services\DeleteService;

class CClassDeleteService extends DeleteService
{
    protected $model = CClass::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];
    protected $triggerAfterDelete = ['deleteAsWell'];

    protected function deletionConstraints($obj)
    {
        $enrollments = Enrollment::where('class_id',$obj->id)->count();
        $evaluations = Evaluation::where('class_id',$obj->id)->count();
        $lessons = Lesson::where('class_id',$obj->id)->count();

        if(($enrollments+$evaluations+$lessons) > 0)
            throw new DeletionException(['enrollments' => $enrollments, 'evaluations' => $evaluations, 'lessons' => $lessons]);

        return $obj;
    }

    protected function deleteAsWell($obj) {
        Journal::where('class_id',$obj->id)->delete();
    }
}
