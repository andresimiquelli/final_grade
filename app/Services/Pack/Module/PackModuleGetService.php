<?php

namespace App\Services\Pack\Module;

use App\Models\PackModule;
use App\Services\GetService;

class PackModuleGetService extends GetService
{
    protected $model = PackModule::class;
    protected $with_fields = ['pack','subjects','subjects.subject'];
}