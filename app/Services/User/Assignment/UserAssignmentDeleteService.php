<?php

namespace App\Services\User\Assignment;

use App\Exceptions\DeletionException;
use App\Models\Evaluation;
use App\Models\Lesson;
use App\Models\UserAssignment;
use App\Services\DeleteService;

class UserAssignmentDeleteService extends DeleteService
{
    protected $model = UserAssignment::class;
    protected $triggerBeforeDelete = ['checkBeforeDelete'];

    protected function checkBeforeDelete($assignment)
    {
        $lessons = Lesson::where('user_id',$assignment->teacher->id)->get();
        if($lessons)
        {
            if(count($lessons)>0)
                throw new DeletionException();
        }        
        
        $evaluations = Evaluation::where('user_id',$assignment->teacher->id)->get();
        if($evaluations)
        {
           if(count($evaluations)>0)
            throw new DeletionException(); 
        }
        
    }
}