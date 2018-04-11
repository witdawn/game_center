<?php

namespace App\Http\Controllers;


use App\Models\Account;

class IndexController extends Controller
{
    public function index()
    {
        Account::find(123);
        return view('welcome');
    }


    public function logout()
    {
    }
}
