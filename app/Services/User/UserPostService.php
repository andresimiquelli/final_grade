<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\PostService;
use Illuminate\Support\Facades\Hash;

class UserPostService extends PostService
{
    protected $model = User::class;
    protected $triggerBeforeStore = ['hashPassword'];

    protected function hashPassword($data) 
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }
}