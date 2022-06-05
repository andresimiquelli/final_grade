<?php

namespace App\Services\Pack;

use App\Models\Pack;
use App\Services\PostService;

class PackPostService extends PostService
{
    protected $model = Pack::class;
}