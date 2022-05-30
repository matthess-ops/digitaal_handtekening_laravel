<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use Illuminate\Http\Request;
use App\Signature;
use App\Document;

class TestController extends Controller
{
    public function testdb(){
        error_log("hopelijk werkt dit");
        // User::create([
        //     'firstname' => "huh",
        //     'lastname' => "huh",

        //     'email' => "asdddddfasdfhuh",
        //     'password' => bcrypt('password'),
        //     'is_admin' => False,
        // ]);

        // $newSig = new Signature();

        // $newSig->test = "werkt dit";
        // $newSig->save();
        try {

            Signature::create([
                'test' => "huh",

            ]);
          } catch (\Exception $e) {

            error_log($e->getMessage());
              return $e->getMessage();
          }

        error_log("dones");
        // echo "lefuck";

    }


    public function unprotected(){
        error_log("unprotected alled");
        return "unprotected call werkt";
    }

    public function unprotectedpost(){
        error_log("unprotectedpost alled");
        return "unprotectedpost call werkt";
    }

    public function testsig(){
        $data = User::find('4')->documents;
        foreach ($data as $dat) {
            $sig = $data->signature;
            error_log(json_encode($sig));
        }

        echo $data;
    }
}
