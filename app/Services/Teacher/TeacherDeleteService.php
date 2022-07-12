<?php

namespace App\Services\Teacher;

use App\Events\UserBeforeDelete;
use App\Models\Teacher;
use App\Services\DeleteService;
use App\Services\Teacher\Assignment\TeacherAssignmentDeleteService;

class TeacherDeleteService extends DeleteService
{
    protected $model = Teacher::class;
    protected $triggerBeforeDelete = ['deleteAssignments'];

    protected function deleteAssignments($teacher)
    {
        $service = new TeacherAssignmentDeleteService();
        $service->deleteBy('teacher_id', $teacher->id);
        return $teacher;
    }
}