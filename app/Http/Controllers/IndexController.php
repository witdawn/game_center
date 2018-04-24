<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{

    public function test()
    {
        return view('mobile.index');
    }

    public function index()
    {
        return view('index.index');
    }

    public function questions()
    {
        $account = account_info();
        return view('index.ques', ['account' => $account]);
    }


    public function activities()
    {
        $account = account_info();
        $activities=$account->activities;
        return view('index.activities',['activities'=>$activities]);
    }

    public function login()
    {
        return view('index.login');
    }
}
