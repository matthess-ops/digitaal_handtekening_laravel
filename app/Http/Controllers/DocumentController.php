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
    public function userDocument($userid,$documentid){
        error_log("userdocument function in documentcontroller called");
        error_log($userid." ".$documentid);
        $user = User::find($userid);
        $document = Document::find($documentid);
        $admin = User::find(auth('sanctum')->user()->id);
        return response()->json([
            'status'        => 'success',
            'user'=>$user,
            'document'=>$document,
            'admin'=>$admin,

        ]);
    }

    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required'
        ]);

        error_log("user id is " . $request->input('userId'));
        $newDocument = new Document;

        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('documents', $file_name, 'public');
            $pathToSave = "storage\app\public\\" . $file_path;
            error_log($file_name);
            error_log($file_path);
            error_log($pathToSave);
            $newDocument->user_id = $request->input('userId');
            $newDocument->filepath = $pathToSave;
            $newDocument->filename = $file_name;
            $newDocument->save();
            return response()->json([
                'status'        => 'success',
                'data' =>   $newDocument,
            ]);
        }
    }


    public function userDocuments()
    {
        error_log("documentController@getdocuments called");
        error_log("user id " . auth('sanctum')->user()->id);
        $user = User::find(auth('sanctum')->user()->id);
        $documents = $user->documents;
        return $documents;
    }

    public function adminGetUserDocuments($id)
    {
        error_log("werkt dit");
        error_log("documentcontroller show called with userid " . $id);
        $user = User::find($id);
        if ($user != null) {
            $documents = User::find($id)->documents; // have to use User::find because when using $user you will also get the document data
            return response()->json([
                'status'        => 'success',
                'user' => $user,
                'documents' => $documents,

            ]);
        }

        return response()->json([
            'status'        => 'failed',
            'message' => "Gebruiker is niet gevonden",

        ]);
    }




    public function download($id)
    {
        error_log("downloadFile function called =" . $id);
        $file = Document::find($id);
        $path = storage_path() . "\\app\\public\\documents\\" . $file["filename"];
        $filemimetype = Storage::mimeType("\\public\\documents\\" . $file["filename"]);    //   error_log("mimeytype ".$mimeType);

        $headers = [
            'Content-Type' => $filemimetype,
        ];
        error_log("downloading file " . $file["filename"] . " mimetype " . $filemimetype);
        return response()->download($path, $file["filename"]);
    }



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
        $file->delete();
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
