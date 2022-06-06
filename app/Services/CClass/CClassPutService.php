<?php

namespace App\Services\CClass;

use App\Models\CClass;
use App\Services\PutService;

class CClassPutService extends PutService
{
    protected $model = CClass::class;
}