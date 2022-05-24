<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Signature;
use Illuminate\Support\Facades\Storage;
use App\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Test;



class SignatureController extends Controller
{

    public function changeStatus(Request $request)
    {
        $signedDocumentId = $request->input("id");
        $newStatus = $request->input("newStatus");
        $userId = auth('sanctum')->user()->id;
        $signedDocument = Signature::find($signedDocumentId);
        if ($signedDocument->user_id == $userId) {
            error_log("the same user");
            $signedDocument->signed_status = $newStatus;
            $signedDocument->save();
            error_log("everything worked");
            return response()->json([
                'status'        => 'success',
                'data'=>$signedDocument->id,
            ]);
        } else {
            return response()->json([
                'status'        => 'failure',
            ]);
        }
        error_log("change status is called");
        error_log(json_encode($request->all()));
    }

    public function userIndex()
    {
        error_log("userindex function called");
        $userId = auth('sanctum')->user()->id;
        error_log($userId);
        try {
            $userSignatures = User::find($userId)->signatures;
            error_log($userSignatures);
            return response()->json([
                'status'        => 'success',
                'data' =>  $userSignatures,
            ]);
        } catch (\Exception $e) {

            error_log($e->getMessage());
            return $e->getMessage();
        }
    }

    public function index()
    {
        error_log("signatureController@index called");

        try {
            $signedDocuments = Signature::with('user')->get();
            return response()->json([
                'status'        => 'success',
                'data' => $signedDocuments,
            ]);
        } catch (\Exception $e) {

            error_log($e->getMessage());
            return $e->getMessage();
        }
    }




    public function create(Request $request)
    {

        error_log(
            "create function called signupcontroller"
        );



        error_log(json_encode($request->all()));

        $validator = Validator::make($request->all(), [
            'sendTo' => 'required|email',
            'text' => '',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'        => 'failed',
                'errors' =>  $validator->errors(),
            ]);
        } else {

            $file = Document::find($request->input('documentId'));
            $path = storage_path() . "\\app\\public\\documents\\" . $file["filename"];
            $copyToPath = storage_path() . "\\app\\public\\signatureDocuments\\" . time() . '_' . $file["filename"];
            error_log($path);
            error_log("copy file");
            File::copy($path, $copyToPath);

            error_log("werkt tot hier");


            try {

                Signature::create([
                    'signed_at' => null,
                    'user_id' => $request->input('userId'),
                    'filepath' => $copyToPath,
                    'filename' => $file["filename"],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'signed_status' => "open",
                    'send_to' => $request->input('sendTo'),
                    'applicant' => $request->input('applicant'),
                    'text' => $request->input('text'),


                ]);
            } catch (\Exception $e) {

                error_log($e->getMessage());
                return $e->getMessage();
            }



            error_log("dit werkt niet meer");

            return response()->json([
                'status'        => 'success',
            ]);
        }
    }
}
