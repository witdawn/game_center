<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\QuestionWinner;
use Illuminate\Http\Request;

class ScreenController extends Controller
{

    //答题首页
    public function questionIndex(Request $request)
    {
        $active = Activity::find($request->active->id);
        return view('screen.index', ['active' => $active]);
    }


    //放题页面
    public function questions(Request $request)
    {
        $active = Activity::find($request->active->id);
        return view('screen.question', ['active' => $active]);
    }

    //光荣榜
    public function winnerRank(Request $request)
    {
        $active = Activity::find($request->active->id);
        $round_number = $active->question_round;
        $active_id = $active->id;
        $winners = QuestionWinner::getWinners($active_id, $round_number);
        return view('screen.rank', ['active' => $request->active, 'winners' => $winners]);
    }
}
