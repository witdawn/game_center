<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreenController extends Controller
{
    protected $active;

    public function questions()
    {
        return view('screen.questions');
    }
}
