<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private $active;
    private $gamer;
    private $module;

    public function index(Request $request)
    {
        dd(session('an_game'));
        $request->session()->forget('an_game');
    }

    public function question()
    {
        return view('mobile.questione', ['user' => $this->gamer, 'active' => $this->active]);
    }

    #获取身份信息
    public function GameAuth(Request $request)
    {
        $gamer['openid']=333777344433;
        session(['an_game'=>$gamer]);
        return redirect('game/' . $request->module);
        $account = Account::find($request->active['account_id'])->toArray();
        dd($account);
        if (!$request->has('code')) {
            $url = route('game_auth');
            wxAuth($url, $account);
        } else {
            $token = wxAccessToken($request->code, $account);
            $userinfo = tokenToinfo($token);
            $gamer = User::where('openid', $userinfo['openid'])->where('active_id', $this->active['id'])->first();
            if (!$gamer) {
                $gamer = User::add($userinfo);
            }
            session('an_game', $gamer);
            $this->gamer = $gamer;
            return redirect('game/' . $this->module);
        }
    }

}
