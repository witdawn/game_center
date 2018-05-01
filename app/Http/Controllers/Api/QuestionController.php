<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Question;
use App\Models\QuestionWinner;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //切换游戏进度
    public function change_round(Request $request)
    {
        Activity::change_round($request->active->id);
        return rJson();
    }

    public function addQuestion(Request $request)
    {
        $account = account_info();
        $activity = $account->activities()->first();
        $round = $request->get('qr');
        $question=new Question();
        $question->active_id=$activity->id;
        $question->round_number=$round;
        $question->answer=$request->answer;
        $question->save();
        return rJson();
    }

    #获取问题
    public function getQuestions(Request $request)
    {
        $round = $request->get('qr');
        $account = account_info();
        $activity = $account->activities()->first();
        $questions = Question::where('active_id', $activity->id)->where('round_number', $round)->get();
        return rJson($questions);
    }

    #清空问题
    public function deleteQuestions(Request $request)
    {
        $round = $request->get('qr');
        $account = account_info();
        $activity = $account->activities()->first();
        Question::where('active_id', $activity->id)->where('round_number', $round)->delete();
        return rJson();
    }

    #获奖名单
    public function getWinners(Request $request)
    {
        $round = $request->get('qr');
        $account = account_info();
        $activity = $account->activities()->first();
        $active_id = $activity->id;
        $winners = QuestionWinner::getWinners($active_id, $round);
        return rJson($winners);
    }
}
