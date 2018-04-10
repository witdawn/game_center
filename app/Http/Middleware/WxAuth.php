<?php

namespace App\Http\Middleware;

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
            return redirect('game/auth');
        }
        $request->offsetSet('game_user', $gamer);
        return $next($request);
    }
}
