<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function unprotected(){
        error_log("unprotected alled");
        return "unprotected call werkt";
    }

    public function unprotectedpost(){
        error_log("unprotectedpost alled");
        return "unprotectedpost call werkt";
    }
}
