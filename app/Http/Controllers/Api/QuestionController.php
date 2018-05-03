<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GeneralException;
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

    #添加/编辑问题
    public function addQuestion(Request $request)
    {
        if ($request->has('id')) {
            $question = Question::find($request->id);
        } else {
            $account = account_info();
            $activity = $account->activities()->first();
            $question = new Question();
            $question->active_id = $activity->id;
            $question->round_number = $request->round_number;
        }
        $question->title = '第' . $request->display_order . "题：" . $request->title;
        $question->options = $request->options;
        $question->answer = $request->answer;
        $question->display_order = $request->display_order;
        $question->score = $request->score;
        $question->save();
        $questions = Question::where('active_id', $question->active_id)->where('round_number', $question->round_number)->get();
        return rJson($questions);

    }


    #获取问题列表
    public function getQuestions(Request $request)
    {
        $round = $request->get('round_number');
        $account = account_info();
        $activity = $account->activities()->first();
        $questions = Question::where('active_id', $activity->id)->where('round_number', $round)->get();
        return rJson($questions);
    }

    #删除问题并返回新列表
    public function deleteQuestion(Request $request)
    {
        $question = Question::find($request->id);
        if (!$question)
            throw new GeneralException('该条信息不存在');
        $question->delete();
        $questions = Question::where('active_id', $question->active_id)->where('round_number', $question->round_number)->get();
        return rJson($questions);
    }

    #清空问题
    public function cleanUpQuestions(Request $request)
    {
        $round = $request->get('round_number');
        $account = account_info();
        $activity = $account->activities()->first();
        Question::where('active_id', $activity->id)->where('round_number', $round)->delete();
        return rJson();
    }

    #获奖名单
    public function getWinners(Request $request)
    {
        $round = $request->get('round_number');
        $account = account_info();
        $activity = $account->activities()->first();
        $active_id = $activity->id;
        $winners = QuestionWinner::getWinners($active_id, $round);
        return rJson($winners);
    }

    #清空获奖名单
    public function cleanUpWinners(Request $request)
    {
        $round = $request->get('round_number');
        $account = account_info();
        $activity = $account->activities()->first();
        $active_id = $activity->id;
        QuestionWinner::where('active_id', $active_id)->where('round_number', $round)->delete();
        return rJson();
    }
}
