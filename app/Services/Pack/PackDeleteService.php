<?php

namespace App\Services\Pack;

use App\Models\Pack;
use App\Services\DeleteService;

class PackDeleteService extends DeleteService
{
    protected $model = Pack::class;
}