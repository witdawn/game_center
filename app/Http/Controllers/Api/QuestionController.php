<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //切换游戏进度
    public function change_round(Request $request)
    {
        Activity::change_round($request->active->id, $request->round_num);
        return rJson();
    }
}
