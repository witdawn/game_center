<?php

namespace App\Http\Middleware;

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
        $gamer = session('an_game');
        if (!$gamer['openid']) {
            $url = route('game_auth', ['a' => $request->active->id, 'm' => $request->module]);
//            $account['appid'] = 'wxf50ad054693ef907';
//            $account['appsecret'] = '10932473244fcc0c4e10afbdcd391d39';
//            $wxAuth = new GetAuth($account['appid'], $account['appsecret']);
//            return $wxAuth->getCode($url);
            $account['appid'] = 'wx0c1d6ee302dc4a70';
            $account['appsecret'] = 'UMc15F5HbcPIe9BxnD84PwNA5wXRp6ua5kXbjVglpBk';
            $companyAuth = new WxCompanyAuth($account['appid'], $account['appsecret']);
            return $companyAuth->getCode($url);

        }
        $request->offsetSet('gamer', $gamer);
        unset($gamer);
        return $next($request);
    }
}
