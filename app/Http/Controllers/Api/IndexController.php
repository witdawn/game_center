<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Index\LoginRequest;
use App\Models\Account;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @throws GeneralException
     */
    public function login(LoginRequest $request)
    {
        $account = Account::where(['account' => $request->username, 'password' => sha1($request->password)])->first();
        if (!$account)
            throw new GeneralException('用户名或密码错误', '30002');
        session(['an_account' => $account]);
        return rJson([], '登录成功');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return rJson();
    }

    public function getActivities()
    {
        $account = account_info();
        $activities = $account->activities;
        return rJson($activities);
    }

}
