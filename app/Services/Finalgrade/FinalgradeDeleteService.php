<?php

namespace App\Services\Finalgrade;

use App\Models\Finalgrade;
use App\Services\DeleteService;

class FinalgradeDeleteService extends DeleteService
{
    protected $model = Finalgrade::class;
}