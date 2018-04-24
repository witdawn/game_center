<?php

namespace App\Http\Middleware;

use Closure;

class AccountLogin
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
        $account=session('an_account');
        if(!$account['id'])
            return redirect('login');
        return $next($request);
    }
}
