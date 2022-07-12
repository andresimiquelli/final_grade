<?php

namespace App\Services\Teacher\Assignment;

use App\Exceptions\DeletionException;
use App\Models\Evaluation;
use App\Models\Lesson;
use App\Models\TeacherAssignment;
use App\Services\DeleteService;

class TeacherAssignmentDeleteService extends DeleteService
{
    protected $model = TeacherAssignment::class;
    protected $triggerBeforeDelete = ['checkBeforeDelete'];

    protected function checkBeforeDelete($assignment)
    {
        $lessons = Lesson::where('teacher_id',$assignment->teacher->id);
        if(count($lessons)>0)
            throw new DeletionException();
        
        $evaluations = Evaluation::where('teacher_id',$assignment->teacher->id);
        if(count($evaluations)>0)
            throw new DeletionException();
    }
}