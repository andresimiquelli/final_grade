<?php

namespace App\Services\User;

use App\Exceptions\DataValidationException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordService
{
    public function change($id, $data) {

        $user = User::find($id);

        if(!$user)
            throw new ResourceNotFoundException(User::class);

        if(!Hash::check($data['currentPassword'], $user->password))
            throw new DataValidationException(['currentPassword' => 'different']);

        if($data['password'] != $data['passwordConfirm'])
            throw new DataValidationException(['passwordConfirm' => 'different']);

        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }
}
