<?php

namespace App\Http\Controllers;

use App\Extension\WxSdk\GetAuth;
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
//        $userinfo['openid'] = str_random(16);
//        $userinfo['active_id'] = $request->active->id;
//        $gamer = User::where('openid', $userinfo['openid'])->where('active_id', $request->active->id)->first();
//        if (!$gamer) {
//            $gamer = User::add($userinfo);
//        }
//
//        session(['an_game' => $gamer]);
//        return redirect('game/' . $request->module);
//        $account = Account::find($request->active->account_id)->toArray();
        $account['appid'] = 'wxf50ad054693ef907';
        $account['appsecret'] = '10932473244fcc0c4e10afbdcd391d39';
        $wxAuth = new GetAuth($account['appid'], $account['appsecret']);
        if (!$request->has('code')) {
            $url = route('game_auth');
            $wxAuth->getCode($url);
        } else {
            $user_info = $wxAuth->getUserInfo($request->code);
            $gamer = User::where('openid', $user_info['openid'])->where('active_id', $request->active->id)->first();
            if (!$gamer) {
                $gamer = User::add($user_info);
            }
            session('an_game', $gamer);
            return redirect('game/' . $request->module);
        }
    }

}
