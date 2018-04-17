<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;

class GameAuth
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
        if (!session('game_active') && !$request->has('a')) {
            return error_page('无效的活动链接');
        } else if ($request->has('a')) {
            $selects = [
                'account_id',
                'question_round',
                'title',
                'mobile_back',
                'modules',
                'id',
            ];
            $active = Activity::select($selects)->find($request->a);
            if (!$active)
                return error_page('未找到指定的活动');
            session(['game_active' => $active->toArray()]);
        }
        if ($request->has('m')) {
            $allow_modules = unserialize(session('game_active')['modules']);
            if (!in_array($request->m, $allow_modules))
                return error_page('该模块未开通');
            session(['an_module' => $request->m]);
        }
        $module = session('an_module') ? session('an_module') : 'index';
        $request->offsetSet('active', session('game_active'));
        $request->offsetSet('module', $module);
        $request->offsetSet('gamer', session('an_game'));
        unset($module);
        return $next($request);
    }
}
