<?php

namespace App\Services\Pack\Module\Subject;

use App\Models\PackModuleSubject;
use App\Services\GetService;

class PackModuleSubjectGetService extends GetService
{
    protected $model = PackModuleSubject::class;
    protected $with_fields = ['subject','module','module.pack'];
    protected $orderBy = [['order']];
}
