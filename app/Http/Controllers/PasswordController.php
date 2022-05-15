<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mime\Message;

class PasswordController extends Controller
{
    public function reset(Request $request)
    {
        error_log("reset password called");
        $validator = Validator::make($request->all(), [
            'email' => 'required:email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'        => 'failed',
                'message' =>   'Enter email adress'
            ]);
        } else {
            $userEmail = $request->input("email");
            $user =  User::where('email', $userEmail)->first();
            error_log(json_encode($user));

            if ($user) {

                $credentials = ['email' => $user->email];
                $response = Password::sendResetLink($credentials);

                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return response()->json([
                            'status'        => 'success',
                            'message' => 'Password reset link send into mail.',
                        ]);
                    case Password::INVALID_USER:
                        return response()->json([
                            'status'        => 'failed',
                            'message' =>   'Unable to send password reset link.'
                        ]);
                }
            } else {
                return response()->json([
                    'status'        => 'failed',
                    'message' =>   'user detail not found!'
                ]);
            }
        }
    }
}
