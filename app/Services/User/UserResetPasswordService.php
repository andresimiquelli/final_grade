<?php

namespace App\Services\User;

use App\Exceptions\ResourceNotFoundException;
use App\Mail\ResetPasswordMail;
use Keygen\Keygen;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserResetPasswordService
{
    public function reset($id)
    {
        $user = User::find($id);
        if(!$user)
            throw new ResourceNotFoundException(User::class);

        $password = Keygen::numeric(6)->generate();

        $mail = new ResetPasswordMail($user, $password);
        $mail->subject("Redefinição de senha");
        Mail::to($user->email)->send($mail);
    }
}
