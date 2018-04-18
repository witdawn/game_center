<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Index\LoginRequest;
use App\Models\Account;

class IndexController extends Controller
{
    public function login(LoginRequest $request)
    {
        $select = ['username', 'last_login_at', 'status', '_id', 'last_login_ip'];
        $account = Account::where(['username' => $request->username, 'password' => sha1($request->password)])->select($select)->first();
        if (!$account)
            throw new GeneralException('用户名或密码错误', '30002');
        session('an_account',$account);
        return rJson([], '登录成功');
    }

    public function logout()
    {
        session_destroy();
    }

}
