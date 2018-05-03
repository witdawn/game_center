<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function test()
    {
//        return view('mobile.question');
    }

    //账户首页
    public function index()
    {
        $account = account_info();
        $activity = $account->activities()->first();
        return redirect(route('q_index', ['a' => $activity->id]));
//        return view('index.index');
    }

    //问题管理
    public function question_manager(Request $request)
    {
        if (!$request->has('r')) {
            $account = account_info();
            $activity = $account->activities()->first();
            return view('index.questions_list', ['max_round' => $activity->max_question_round]);
        }
        return view('index.questions', ['round' => $request->get('r')]);
    }

    //获奖名单
    public function question_winners(Request $request)
    {
        if (!$request->has('r'))
            return error_page('无效的连接');
        return view('index.winners', ['round' => $request->get('r')]);
    }


    public function login()
    {
        return view('index.login');
    }
}
