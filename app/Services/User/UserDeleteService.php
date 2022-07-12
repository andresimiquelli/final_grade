<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\DeleteService;
use App\Services\Teacher\TeacherDeleteService;

class UserDeleteService extends DeleteService
{
    protected $model = User::class;
    protected $triggerBeforeDelete = ['deleteTeachers'];

    protected function deleteTeachers($user) 
    {
        $service = new TeacherDeleteService();
        $service->deleteBy('user_id', $user->id);
        return $user;
    }
}