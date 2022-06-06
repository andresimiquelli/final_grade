<?php

namespace App\Services\Pack\Module\Subject;

use App\Models\PackModuleSubject;
use App\Services\PostService;

class PackModuleSubjectPostService extends PostService
{
    protected $model = PackModuleSubject::class;
}