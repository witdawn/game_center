<?php

namespace App\Http\Middleware;

use App\Extension\WxSdk\GetAuth;
use App\Extension\WxSdk\WxCompanyAuth;
use Closure;

class WxAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $active = $request->active;
        $account = $active->account;
        $gamer = session('an_game');
        if (!$gamer['openid']) {
            $url = route('game_auth', ['a' => $request->active->id, 'm' => $request->module]);
            if ($account->wx_type == 0) {
                $wxAuth = new GetAuth($account->appid, $account->appsecret);
            } else {
                $wxAuth = new WxCompanyAuth($account->appid, $account->appsecret);
            }
            return $wxAuth->getCode($url);
        }
        $request->offsetSet('gamer', $gamer);
        unset($gamer);
        return $next($request);
    }
}
