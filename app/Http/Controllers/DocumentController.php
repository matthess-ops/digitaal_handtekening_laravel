<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Document;
use Error;
use Symfony\Component\HttpFoundation\File\File;


class DocumentController extends Controller
{

    // return all documents associated to an user
    //
    // only admin
    public function index()
    {
        error_log("documentController@index called");
        error_log(auth('sanctum')->user()->id);
        $user = User::find(auth('sanctum')->user()->id);
        $documents = $user->documents;
        return $documents;
    }

    public function show($id){
        error_log("werkt dit");
        error_log("documentcontroller show called with userid ".$id);
        $user = User::find($id);
        $documents = $user->documents;
        return $documents;


    }

    // public function downloadtest()
    // {
    //     error_log("test fucntion called");
    //     $path = public_path() . '/testimage.png'; //werkt
    //     // $path = public_path() . '/test.pdf'; //werkt
    //     // $path = 'C:\Users\matthijn\Desktop\documenten\boiler-plate-laravel-sanctum-main\public\test.pdf';
    //     error_log("lfuck " . $path);
    //     return response()->download($path);
    // }

    // public function downloadworks($id)
    // {
    //     error_log("download file function called id =" . $id);
    //     $file = Document::find($id);
    //     //   error_log(print_r($file,true));
    //     $path = storage_path() . "\\app\\public\\documents\\" . $file["filename"];
    //     $filemimetype = Storage::mimeType("\\public\\documents\\" . $file["filename"]);    //   error_log("mimeytype ".$mimeType);
    //     // error_log($mimetype);
    //     // error_log($path);
    //       $headers = [
    //         'Content-Type' => $filemimetype,
    //     ];
    //     error_log("donwload file ".$file["filename"] ." mimetype ".$filemimetype);
    //     return response()->download($path, $file["filename"]);
    // }


    public function downloadFile($id){
        error_log("downloadFile function called =" . $id);
        $file = Document::find($id);
        $path = storage_path() . "\\app\\public\\documents\\" . $file["filename"];
        $filemimetype = Storage::mimeType("\\public\\documents\\" . $file["filename"]);    //   error_log("mimeytype ".$mimeType);

          $headers = [
            'Content-Type' => $filemimetype,
        ];
        error_log("downloading file ".$file["filename"] ." mimetype ".$filemimetype);
        return response()->download($path, $file["filename"]);

    }


    // public function download()
    // {

    //     $path = public_path() . '/testimage.png'; //werkt
    //     error_log("dit werkt ".$path);
    //     return response()->download($path);
    // }

    // return user data
    // user ClientShowResource
    // for all users

    // validate and store a new user
    // return response 200 succesfull else return validation errors
    public function store(Request $request)
    {
    }

    // update user password
    // return response 200 succesfull else return validation errors
    public function update(Request $request, $id)
    {
    }



    // only an admin can destroy client and associated document data
    // check if auth is is_admin
    // remove documents
    //seend response 200 or error
    public function destroy($id)
    {
        error_log("destory documentController function called =" . $id);
        $file = Document::find($id);
        $path = storage_path() . "\\app\\public\\documents\\" . $file["filename"];
        unlink($path); // dont want to delete test files during development
        $file ->delete();
        return response()->json([
            'status'        => 'success',
            'message' =>   'succesfull deleted file',
        ]);

    }

    // search firstname and secondname column for matches
    // return neccessary user data, use ClientIndexResource

    public function search($string)
    {
    }
}
