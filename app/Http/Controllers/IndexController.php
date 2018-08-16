<?php

namespace App\Http\Controllers;


use App\Exports\WinnerExport;
use App\Jobs\TakeTest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{

    public function test()
    {
//        return view('mobile.index');
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

    //下载获奖名单
    public function downloadWinners(Request $request)
    {
        $round = $request->get('round_number');
        $account = account_info();
        $activity = $account->activities()->first();
        $active_id = $activity->id;
        $file_name = "第" . $round . "轮获奖名单";
        Excel::download(new WinnerExport($active_id, $round), $file_name);
    }


    public function login()
    {
        return view('index.login');
    }

}
