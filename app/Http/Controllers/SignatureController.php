<?php

namespace App\Http\Controllers;

use App\Document;
use App\Signature;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SignatureController extends Controller
{
    // downloads the signed document.
    public function downloadSigned($id)
    {
        $file = Signature::find($id);
        $path = $file["filepath"];
        $filemimetype = File::mimeType($file["filepath"]);

        $headers = [
            'Content-Type' => $filemimetype,
        ];
        error_log("downloading file " . $file["filename"] . " mimetype " . $filemimetype);
        return response()->download($path, $file["filename"]);
    }
    // change the status of a signed document (open, not_agreed, signed)
    // see changesv2.md for more information
    public function changeStatus(Request $request)
    {
        $signedDocumentId = $request->input("id");
        $newStatus = $request->input("newStatus");
        $userId = auth('sanctum')->user()->id;
        $signedDocument = Signature::find($signedDocumentId);
        if ($signedDocument->user_id == $userId) { // check if the user sending the request is the owner of the document
            $signedDocument->signed_status = $newStatus;
            $signedDocument->save();
            return response()->json([
                'status' => 'success',
                'data' => $signedDocument->id,
            ]);
        } else {
            return response()->json([
                'status' => 'failure',
            ]);
        }

    }
    //return all signed documents belonging to this user
    public function userIndex()
    {
        $userId = auth('sanctum')->user()->id;
        try {
            $userSignatures = User::find($userId)->signatures;
            return response()->json([
                'status' => 'success',
                'data' => $userSignatures,
            ]);
        } catch (\Exception $e) {

            error_log($e->getMessage());
            return $e->getMessage();
        }
    }
    // get all all currenlty signed documents.
    // v2 should only be accesible by an admin
    public function index()
    {

        try {
            $checkAdmin = auth('sanctum')->user()->is_admin;
            if ($checkAdmin == true) {
                $signedDocuments = Signature::with('user')->get();
                return response()->json([
                    'status' => 'success',
                    'data' => $signedDocuments,
                ]);
            }
        } catch (\Exception $e) {

            error_log($e->getMessage());
            return $e->getMessage();
        }
    }

    // create a new signature db entry. Also copy the document to be signed to
    // signatureDocuments folder. This is needed becuase these documents need to be saved
    // in case if there is a conflict between user and admin in the future.
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sendTo' => 'required|email',
            'text' => '',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors(),
            ]);
        } else {

            // find the document of interest to be saved in deh signature documents folder
            $file = Document::find($request->input('documentId'));
            $path = storage_path() . "\\app\\public\\documents\\" . $file["filename"];
            $copyToPath = storage_path() . "\\app\\public\\signatureDocuments\\" . time() . '_' . $file["filename"];

            File::copy($path, $copyToPath);

            try {

                $newSig = Signature::create([
                    'signed_at' => null, // since the document is not signed by the user in the beginning set this to null
                    'user_id' => $request->input('userId'),
                    'filepath' => $copyToPath,
                    'filename' => $file["filename"],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'signed_status' => "open",
                    'send_to' => $request->input('sendTo'),
                    'applicant' => $request->input('applicant'),
                    'text' => $request->input('text'),
                    'document_id' => $request->input('documentId'),

                ]);

                $file->signature_id = $newSig->id; // change the document signature_id to the newly created signature documet id
                $file->save();
            } catch (\Exception $e) {

                error_log($e->getMessage());
                return $e->getMessage();
            }


            return response()->json([
                'status' => 'success',
            ]);
        }
    }
}
