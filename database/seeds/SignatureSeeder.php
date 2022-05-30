<?php

use Illuminate\Database\Seeder;
use app\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SignatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     *
     */

    // creates the signatures db entries.
    // creates for all the documents in the signatureDocuments for each user
    // and signature entry in the db. Each entry has an random signed status (signed, open, not_agreed)
    public function run()
    {
        $files = glob('storage\app\public\signatureDocuments\*');

        $users = User::all();


        foreach ($users as $user) {
            foreach ($files as $file) {

                $signedVars = ["signed","open","not_agreed"];
                $signedAt = null;
                $signedState = $signedVars[array_rand($signedVars)];
                if($signedState == "signed"){
                    $signedAt = Carbon::now();
                }
                $splitFilename = explode('\\', $file);
                DB::table('signatures')->insert([
                    'user_id' => $user->id,
                    'filepath' => $file,
                    'filename' => end($splitFilename),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'signed_at' => $signedAt,
                    'signed_status' => $signedState,
                    'send_to' => "test@example.nl",
                    'applicant' => "ymko",
                    'text' => "Ik wil dit document naar de gemeente opsturen."
                ]);
            }
        }
    }
}
