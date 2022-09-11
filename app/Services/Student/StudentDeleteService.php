<?php

namespace App\Services\Student;

use App\Exceptions\DeletionException;
use App\Models\Enrollment;
use App\Models\Student;
use App\Services\DeleteService;

class StudentDeleteService extends DeleteService
{
    protected $model = Student::class;
    protected $triggerBeforeDelete = ['deletionConstraints'];

    protected function deletionConstraints($obj)
    {
        $enrollments = Enrollment::where('student_id',$obj->id)->count();

        if($enrollments > 0)
            throw new DeletionException([ 'enrollments' => $enrollments]);

        return $obj;
    }
}
