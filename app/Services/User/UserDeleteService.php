<?php

namespace App\Services\User;

use App\Exceptions\DeletionException;
use App\Models\Evaluation;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserAssignment;
use App\Services\DeleteService;

class UserDeleteService extends DeleteService
{
    protected $model = User::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];
    protected $triggerAfterDelete = ['deleteAsWell'];

    protected function deletionConstraints($obj)
    {
        $evaluations = Evaluation::where('user_id',$obj->id)->count();
        $lessons = Lesson::where('user_id',$obj->id)->count();

        if(($evaluations+$lessons) > 0)
            throw new DeletionException([ 'evaluations' => $evaluations, 'lessons' => $lessons]);

        return $obj;
    }

    protected function deleteAsWell($obj) {
        UserAssignment::where('user_id',$obj->id)->delete();
    }
}
