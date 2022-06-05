<?php

namespace App\Services\Pack\Module;

use App\Models\PackModule;
use App\Services\PostService;

class PackModulePostService extends PostService
{
    protected $model = PackModule::class;
}