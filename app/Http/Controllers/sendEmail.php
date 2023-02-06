<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Http\Request;

class sendEmail extends Controller
{
    function send(){

        $this->validate(request(),['email'=>'required | email']);
       
        $status = Password::sendResetLink(request()->only('email'));

        return $status === Password::RESET_LINK_SENT 
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);

    }


    ////////////////////////////////////////////////////////////////

    function reset_form($token){

       return view('new/reset',compact('token'));
    }

    /////////////////////////////////////////////////////////////

    function reset(){

         $this->validate(request(),[
            'email'=>'required | email',
            'password'=>'required | min:8 | confirmed',
            'token'=>'required',
         ]);

         

         $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    
    }

    


}
