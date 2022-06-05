<?php

namespace App\Services\Pack\Module;

use App\Models\PackModule;
use App\Services\PutService;

class PackModulePutService extends PutService
{
    protected $model = PackModule::class;
}