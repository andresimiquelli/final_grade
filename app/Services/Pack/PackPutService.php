<?php

namespace App\Services\Pack;

use App\Models\Pack;
use App\Services\PutService;

class PackPutService extends PutService
{
    protected $model = Pack::class;
}