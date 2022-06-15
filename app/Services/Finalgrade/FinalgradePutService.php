<?php

namespace App\Services\Finalgrade;

use App\Models\Finalgrade;
use App\Services\PutService;

class FinalgradePutService extends PutService
{
    protected $model = Finalgrade::class;
}