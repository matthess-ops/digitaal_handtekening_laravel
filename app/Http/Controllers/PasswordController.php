<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\User;
use Symfony\Component\Mime\Message;

class PasswordController extends Controller
{
    public function reset(Request $request){
        error_log("reset password function called");
        // error_log(print_r($request->all(),true));
        // error_log("email to reste ".$request->input('email'));
        // $email = $request->input('email');
        // error_log($email);
        // $details = [
        //     'title' => 'reset password',
        //     'body' => 'reset password'
        // ];
       
        // Mail::to($email)->send(new \App\Mail\MyTestMail($details));

        $user =  User::find(2);
        if( $user )
        {
            $credentials = ['email' => $user->email];
            $response = Password::sendResetLink($credentials);
    
            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return response()->json([
                        'status'        => 'success',
                        'message' => 'Password reset link send into mail.',
                        'data' =>''], 201);
                case Password::INVALID_USER:
                    return response()->json([
                        'status'        => 'failed',
                        'message' =>   'Unable to send password reset link.'
                    ], 401);
            }  
        }
        return response()->json([
            'status'        => 'failed',
            'message' =>   'user detail not found!'
        ], 401);
    }
}
