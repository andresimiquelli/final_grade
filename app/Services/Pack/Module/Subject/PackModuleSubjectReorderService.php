<?php
namespace App\Services\Pack\Module\Subject;

use App\Models\PackModuleSubject;
use App\Services\ReorderService;

class PackModuleSubjectReorderService extends ReorderService{

    protected $model = PackModuleSubject::class;
}
