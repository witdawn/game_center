<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function error_page(Request $request)
    {
        return view('error.default', ['msg' => urldecode($request->msg)]);
    }
}
