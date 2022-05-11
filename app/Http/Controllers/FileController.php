<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class FileController extends Controller
{
    public function upload(Request $request){

        $request->validate([
           'file' => 'required'
        ]);

        error_log("user id is ".$request->input('userId'));
        $newDocument= new Document;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('documents', $file_name, 'public');
            $pathToSave = "storage\app\public\\". $file_path;
            error_log($file_name);
            error_log($file_path);
            error_log($pathToSave);
            $newDocument->user_id = $request->input('userId');
            $newDocument->filepath =$pathToSave;
            $newDocument->filename =$file_name;
            $newDocument->save();


            // $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
            // $fileUpload->path = '/storage/' . $file_path;
            // $fileUpload->save();

            return response()->json(['success'=>'File uploaded successfully.']);
        }
   }
}
