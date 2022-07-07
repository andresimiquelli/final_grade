<?php

namespace App\Services\Pack;

use App\Models\Pack;
use App\Services\GetService;

class PackGetService extends GetService
{
    protected $model = Pack::class;

    protected $with_fields = [
        'course'
    ];
}