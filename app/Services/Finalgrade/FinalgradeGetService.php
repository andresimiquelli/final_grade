<?php

namespace App\Services\Finalgrade;

use App\Models\Finalgrade;
use App\Services\GetService;

class FinalgradeGetService extends GetService
{
    protected $model = Finalgrade::class;
    protected $searchable = [
        'enrollment_id',
        'subject_id'
    ];
}