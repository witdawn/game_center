<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ScreenController extends Controller
{

    public function questionIndex(Request $request)
    {
        $active=Activity::find($request->active->id);
        return view('screen.index', ['active' => $active]);
    }

    public function questions(Request $request)
    {
        $active=Activity::find($request->active->id);
        return view('screen.question', ['active' => $active]);
    }

    public function winnerRank(Request $request)
    {
        return view('screen.rank', ['active' => $request->active]);
    }

    public function change_round(Request $request)
    {
        Activity::change_round($request->active->id, $request->round_num);
        return rJson();
    }
}
