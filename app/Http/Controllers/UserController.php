<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        error_log("signup function called");

        $firstname = $request->input('firstname');
        error_log($firstname);

        // $request->validate([
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password'=>'required'
        // ]);


        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',  //
            'password'=>'required'
        ]);

        if ($validator->fails()) {
            error_log("validator failed");
            return response()->json(['error' => $validator->errors()]);
        }else{
              return response()->json([
            'worked' => "yes",
            // 'token' => $user->createToken('bigStore')->accessToken,
        ]);
        }



        // $data = $request->only(['name', 'email', 'password']);
        // $data['password'] = bcrypt($data['password']);

        // $user = User::create($data);
        // $user->is_admin = 0;

        // return response()->json([
        //     'user' => $user,
        //     'token' => $user->createToken('bigStore')->accessToken,
        // ]);
    }

    public function test(Request $request){
        error_log("route is accesed");
        return response()->json([
            'worked' => "yes",]);
    }
}
