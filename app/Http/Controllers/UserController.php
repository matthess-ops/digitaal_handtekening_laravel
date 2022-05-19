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
    // only admins should be able to call this function
    // check for auth is_admin is fture
    public function index()
    {
        error_log("usercontroller index called");
        $checkAdmin = auth('sanctum')->user()->is_admin;
        error_log("is admin " . $checkAdmin);
        if ($checkAdmin == true) {
            error_log("user is admin");
            $users = User::where('is_admin', 'like', false)->orderBy('firstname')->paginate(40);
            error_log("num of found users " . count($users));
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

    public function search($searchterm)
    {

        error_log("usercontroller index called");
        $checkAdmin = auth('sanctum')->user()->is_admin;
        error_log("is admin " . $checkAdmin);
        if ($checkAdmin == true) {
            error_log("user is admin");
            $users = User::where('firstname', 'LIKE', '%' . $searchterm . '%')->orderBy('firstname')->get();
            error_log("num of found users " . count($users));
            return response()->json([
                'status'        => 'success',
                'data' =>   $users,
            ]);
        } else {
            return response()->json([
                'status'        => 'unauthorized',

            ]);
        }





        // error_log("usercontroller search called " . $searchterm);
        // $users = User::where('firstname', 'LIKE', '%' . $searchterm . '%')->get();
        // error_log(json_encode($users));
        // return $users;
    }

    public function signup(Request $request)
    {
        error_log("signup function called");

        $firstname = $request->input('firstname');
        error_log($firstname);




        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',  //
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            error_log("validator failed");
            // return response()->json(['error' => $validator->errors()]);
            return response()->json([
                'status'        => 'failed',
                'errors' =>  $validator->errors(),
            ]);
        } else {
            error_log("dit werkt");
            User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),

                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'is_admin' => False,
            ]);
            error_log("made new user");




            // return response()->json([
            //     'worked' => "yes",
            // ]);
            return response()->json([
                'status'        => 'success',
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

    public function test(Request $request)
    {
        error_log("route is accesed");
        return response()->json([
            'worked' => "yes",
        ]);
    }
}
