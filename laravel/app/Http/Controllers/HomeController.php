<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_index()
    {
        return response()->json(['estado'=>'ok', 'mensaje'=>'Laravel S3'], 200);
    }
}
