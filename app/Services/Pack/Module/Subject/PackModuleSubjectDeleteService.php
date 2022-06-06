<?php

namespace App\Services\Pack\Module\Subject;

use App\Models\PackModuleSubject;
use App\Services\DeleteService;

class PackModuleSubjectDeleteService extends DeleteService
{
    protected $model = PackModuleSubject::class;
}