<?php

namespace App\Http\Controllers;


class GameController extends Controller
{
    public function index()
    {
        echo \currentUser();
        echo 123;
    }

    #获取身份信息
    public function GameAuth()
    {
        $account = getSystemset();
        $code = $_GET['code'];
        if (!isset($code))
        {
            $url =route('game_auth');
            wxAuth($url, $account);
        } else
        {
            $token = wxAccessToken($code, $account);
            $userinfo = tokenToinfo($token);
            $cond['aid'] = $this->active['id'];
            $cond['openid'] = $userinfo['openid'];
            $gamer = M('scene_gamer')->where($cond)->cache(true)->find();
            if (!$gamer)
            {
                $gamer = array();
                $gamer['aid'] = $this->active['id'];
                $gamer['gid'] = 0;
                $gamer['openid'] = $userinfo['openid'];
                $gamer['nickname'] = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '',$userinfo['nickname']);
                $gamer['headimg'] = $userinfo['headimgurl'];
                $gamer['money'] = 0;
                $gamer['id'] = M('scene_gamer')->add($gamer);
                M('scene_active')->where($cond3)->setInc('ipv');
            }
            session('wl_scene_gamer', $gamer);
            $this->gamer = $gamer;
            $this->redirect($this->mod);
        }
    }
}
