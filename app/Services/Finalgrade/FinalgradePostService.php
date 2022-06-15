<?php

namespace App\Services\Finalgrade;

use App\Models\Finalgrade;
use App\Services\PostService;

class FinalgradePostService extends PostService
{
    protected $model = Finalgrade::class;
}