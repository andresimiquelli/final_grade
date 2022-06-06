<?php

namespace App\Services\CClass;

use App\Models\CClass;
use App\Services\PostService;

class CClassPostService extends PostService
{
    protected $model = CClass::class;
}