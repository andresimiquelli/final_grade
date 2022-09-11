<?php

namespace App\Services\Subject;

use App\Exceptions\DeletionException;
use App\Models\PackModuleSubject;
use App\Models\Subject;
use App\Services\DeleteService;

class SubjectDeleteService extends DeleteService
{
    protected $model = Subject::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($subject)
    {
        $count = PackModuleSubject::where('subject_id',$subject->id)->count();
        if($count > 0) {
            throw new DeletionException(['pack_module_subjects' => $count]);
        }

        return $subject;
    }
}
