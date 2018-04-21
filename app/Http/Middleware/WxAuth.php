<?php

namespace App\Http\Middleware;

use App\Extension\WxSdk\GetAuth;
use Closure;

class WxAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $gamer=session('an_game');
        if(!$gamer['openid']){
            $account['appid'] = 'wxf50ad054693ef907';
            $account['appsecret'] = '10932473244fcc0c4e10afbdcd391d39';
            $wxAuth = new GetAuth($account['appid'], $account['appsecret']);
            $url = route('game_auth', ['a' => $request->active->id, 'm' => $request->module]);
            return $wxAuth->getCode($url);
//            return redirect('game/auth');
        }
        $request->offsetSet('gamer', $gamer);
        unset($gamer);
        return $next($request);
    }
}
