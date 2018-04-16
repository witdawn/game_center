<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        $account = account_info();
        return view('index.index',['account'=>$account]);
    }


    public function activies()
    {

        return view('screen.questions');
    }

    public function login()
    {
        return view('index.login');
    }
}
