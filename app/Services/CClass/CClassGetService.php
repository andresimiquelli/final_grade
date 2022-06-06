<?php

namespace App\Services\CClass;

use App\Models\CClass;
use App\Services\GetService;

class CClassGetService extends GetService
{
    protected $model = CClass::class;
    protected $searchable = [
        'name',
        'start_at',
        'end_at',
        'status'
    ];
}