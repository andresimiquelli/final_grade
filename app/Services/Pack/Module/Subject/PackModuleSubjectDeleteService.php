<?php

namespace App\Services\Pack\Module\Subject;

use App\Exceptions\DeletionException;
use App\Models\Evaluation;
use App\Models\Finalgrade;
use App\Models\Journal;
use App\Models\Lesson;
use App\Models\PackModuleSubject;
use App\Models\UserAssignment;
use App\Services\DeleteService;

class PackModuleSubjectDeleteService extends DeleteService
{
    protected $model = PackModuleSubject::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];
    protected $triggerAfterDelete = ['deleteAsWell'];

    protected function deletionConstraints($obj)
    {
        $evaluations = Evaluation::where('pack_module_subject_id',$obj->id)->count();
        $finalgrades = Finalgrade::where('pack_module_subject_id',$obj->id)->count();
        $lessons = Lesson::where('pack_module_subject_id',$obj->id)->count();
        $assignments = UserAssignment::where('pack_module_subject_id',$obj->id)->count();

        if(($evaluations+$finalgrades+$lessons+$assignments) > 0)
            throw new DeletionException([ 'evaluations' => $evaluations, 'finalgrades' => $finalgrades, 'lessons' => $lessons, 'user_assignments' => $assignments]);

        return $obj;
    }

    protected function deleteAsWell($obj) {
        Journal::where('pack_module_subject_id',$obj->id)->delete();
    }
}
