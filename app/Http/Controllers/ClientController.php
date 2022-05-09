<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //return paginated results of users
    // use ClientIndexResource
    // only admin
    public function index()
    {
    }

    // return user data
    // user ClientShowResource
    // for all users
    public function show($id)
    {

    }
    // validate and store a new user
    // return response 200 succesfull else return validation errors
    public function store(Request $request)
    {

    }

  // update user password
    // return response 200 succesfull else return validation errors
    public function update(Request $request,$id)
    {

    }



    // only an admin can destroy client and associated document data
    // check if auth is is_admin
    // remove documents
    //seend response 200 or error
    public function destroy($id)
    {

    }

    // search firstname and secondname column for matches
    // return neccessary user data, use ClientIndexResource

    public function search($string){


    }
}
