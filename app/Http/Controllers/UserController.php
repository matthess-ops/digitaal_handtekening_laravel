<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// use Illuminate\Validation\Validator;

class UserController extends Controller
{
    // get all user data except admin. Only admin should be able to get this data
    public function index()
    {
        $checkAdmin = auth('sanctum')->user()->is_admin;
        if ($checkAdmin == true) {
            $users = User::where('is_admin', 'like', false)->orderBy('firstname')->paginate(40);
            return response()->json([
                'status'        => 'success',
                'data' =>   $users,
            ]);
        } else {
            return response()->json([
                'status'        => 'unauthorized',

            ]);
        }
    }
    //only accescible for admins
    // searches all the user firsntame for matches with searchterm and return the results
    public function search($searchterm)
    {

        $checkAdmin = auth('sanctum')->user()->is_admin;
        if ($checkAdmin == true) {
            $users = User::where('is_admin', 'like', false)->where('firstname', 'LIKE', '%' . $searchterm . '%')->orderBy('firstname')->get();
            return response()->json([
                'status'        => 'success',
                'data' =>   $users,
            ]);
        } else {
            return response()->json([
                'status'        => 'unauthorized',

            ]);
        }
    }

    // public function signup(Request $request)
    // {
    //     error_log("signup function called");

    //     $firstname = $request->input('firstname');
    //     error_log($firstname);
    //     $validator = Validator::make($request->all(), [
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'email' => 'required|email|unique:users,email',  //
    //         'password' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         error_log("validator failed");
    //         // return response()->json(['error' => $validator->errors()]);
    //         return response()->json([
    //             'status'        => 'failed',
    //             'errors' =>  $validator->errors(),
    //         ]);
    //     } else {
    //         error_log("dit werkt");
    //         User::create([
    //             'firstname' => $request->input('firstname'),
    //             'lastname' => $request->input('lastname'),

    //             'email' => $request->input('email'),
    //             'password' => bcrypt($request->input('password')),
    //             'is_admin' => False,
    //         ]);
    //         error_log("made new user");




    //         // return response()->json([
    //         //     'worked' => "yes",
    //         // ]);
    //         return response()->json([
    //             'status'        => 'success',
    //         ]);
    //     }



    //     // $data = $request->only(['name', 'email', 'password']);
    //     // $data['password'] = bcrypt($data['password']);

    //     // $user = User::create($data);
    //     // $user->is_admin = 0;

    //     // return response()->json([
    //     //     'user' => $user,
    //     //     'token' => $user->createToken('bigStore')->accessToken,
    //     // ]);
    // }

    // public function test(Request $request)
    // {
    //     error_log("route is accesed");
    //     return response()->json([
    //         'worked' => "yes",
    //     ]);
    // }
}
