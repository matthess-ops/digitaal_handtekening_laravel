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

    // $table->id();
    // $table->timestamps();
    // $table->timestamp('signed_at');

    // $table->string('user_id');
    // $table->string('filepath');
    // $table->string('filename');
    // $table->boolean('signed');
    // $table->boolean('agreed');
    // $table->string('send_to');
    // $table->string('applicant');
    // $table->string('text');


    public function run()
    {
        error_log("run signature seeder");
        $files = glob('storage\app\public\signatureDocuments\*');
        error_log(print_r($files, true));
        $splitted = explode("/", $files[0]);
        error_log(end($splitted));

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

                       // $table->timestamp('signed_at');

    // $table->string('user_id');
    // $table->string('filepath');
    // $table->string('filename');
    // $table->boolean('signed');
    // $table->boolean('agreed');
    // $table->string('send_to');
    // $table->string('applicant');
    // $table->string('text');

                ]);
            }
        }
    }
}
