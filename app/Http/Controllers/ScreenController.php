<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ScreenController extends Controller
{

    public function questionIndex(Request $request)
    {
        return view('screen.index', ['active' => $request->active]);
    }

    public function questions(Request $request)
    {
        $active=Activity::find($request->active->id);
        return view('screen.question', ['active' => $active]);
    }
}
