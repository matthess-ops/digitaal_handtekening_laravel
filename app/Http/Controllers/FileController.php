<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class FileController extends Controller
{
    // upload an file
    // should only available for admins, since users cannot upload documents
    public function upload(Request $request){

        $checkAdmin = auth('sanctum')->user()->is_admin;
        if ($checkAdmin == true) {
        $request->validate([
           'file' => 'required'
        ]);

        $newDocument= new Document;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('documents', $file_name, 'public');
            $pathToSave = "storage\app\public\\". $file_path;
            $newDocument->user_id = $request->input('userId');
            $newDocument->filepath =$pathToSave;
            $newDocument->filename =$file_name;
            $newDocument->save();
            return response()->json([
                'status'        => 'success',
                'data' =>   $newDocument,
            ]);        }
        }else {
            return response()->json([
                'status'        => 'unauthorized',

            ]);
        }
   }
}
