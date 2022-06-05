<?php

namespace App\Services\Pack\Module;

use App\Models\PackModule;
use App\Services\DeleteService;

class PackModuleDeleteService extends DeleteService
{
    protected $model = PackModule::class;
}