<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\PutService;
use Illuminate\Support\Facades\Hash;

class UserPutService extends PutService
{
    protected $model = User::class;

    protected $triggerBeforeUpdate = ['hashPassword'];

    protected function hashPassword($obj, $old)
    {
        if(is_array($obj))
            if(array_key_exists('password', $obj))
                $obj['password'] = Hash::make($obj['password']);

        return $obj;
    }
}