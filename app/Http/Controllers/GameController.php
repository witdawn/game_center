<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        return view('mobile.open');
    }

    public function question(Request $request)
    {
        return view('mobile.question', ['user' => $request->gamer, 'active' => $request->active]);
    }

    //闯关成功
    public function question_win()
    {
        return view('mobile.open');
    }

    #获取身份信息
    public function GameAuth(Request $request)
    {
        $userinfo['openid'] = str_random(16);
        $userinfo['active_id'] = $request->active->id;
        $gamer = User::where('openid', $userinfo['openid'])->where('active_id', $request->active->id)->first();
        if (!$gamer) {
            $gamer = User::add($userinfo);
        }

        session(['an_game' => $gamer]);
        return redirect('game/' . $request->module);
//        $account = Account::find($request->active->account_id)->toArray();
//        if (!$request->has('code')) {
//            $url = route('game_auth');
//            wxAuth($url, $account);
//        } else {
//            $token = wxAccessToken($request->code, $account);
//            $userinfo = tokenToinfo($token);
//            $gamer = User::where('openid', $userinfo['openid'])->where('active_id', $this->active['id'])->first();
//            if (!$gamer) {
//                $gamer = User::add($userinfo);
//            }
//            session('an_game', $gamer);
//            return redirect('game/' . $this->module);
//        }
    }

}
