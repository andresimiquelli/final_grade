<?php

namespace App\Services\Course;

use App\Exceptions\DeletionException;
use App\Models\Course;
use App\Models\Pack;
use App\Services\DeleteService;

class CourseDeleteService extends DeleteService
{
    protected $model = Course::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $packs = Pack::where('course_id',$obj->id)->count();

        if($packs > 0)
            throw new DeletionException(['packs' => $packs]);

        return $obj;
    }
}
