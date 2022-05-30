<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{


    //sign up function
    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'        => 'failed',
                'errors' =>  $validator->errors(),
            ]);
        } else {
            User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'is_admin' => False,
            ]);

            return response()->json([
                'status'        => 'success',
            ]);
        }
    }
}
