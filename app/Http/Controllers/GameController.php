<?php

namespace App\Http\Controllers;

use App\Extension\WxSdk\GetAuth;
use App\Extension\WxSdk\WxCompanyAuth;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        return view('mobile.index');
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
//        $account['appid'] = 'wxf50ad054693ef907';
//        $account['appsecret'] = '10932473244fcc0c4e10afbdcd391d39';
//        $wxAuth = new GetAuth($account['appid'], $account['appsecret']);
        $account['appid'] = 'wx0c1d6ee302dc4a70';
        $account['appsecret'] = 'UMc15F5HbcPIe9BxnD84PwNA5wXRp6ua5kXbjVglpBk';
        $wxAuth = new WxCompanyAuth($account['appid'], $account['appsecret']);
        if (isset($_GET['code'])) {
            $user_info = $wxAuth->getUserInfo($request->code);
            $gamer = User::where('openid', $user_info['openid'])->where('active_id', $request->active->id)->first();
            if (!$gamer) {
                $gamer = User::add($user_info);
            }
            session(['an_game' => $gamer]);
            return redirect('game/' . $request->module);
        } else {
            return error_page('您访问的页面不存在');
        }
    }

}
