<?php

namespace App\Services\CClass;

use App\Models\CClass;
use App\Services\DeleteService;

class CClassDeleteService extends DeleteService
{
    protected $model = CClass::class;
}