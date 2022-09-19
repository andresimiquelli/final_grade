<?php

namespace App\Services\Pack\Module;

use App\Models\PackModule;
use App\Services\ReorderService;

class PackModuleReorderService extends ReorderService
{
    protected $model = PackModule::class;
}
