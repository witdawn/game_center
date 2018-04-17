<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreenController extends Controller
{
    protected $active;

    public function questions(Request $request)
    {
        $active=$request->active;
        return view('screen.questions',['active'=>$active]);
    }
}
