<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/4/16
 * Time: 11:45
 */

namespace App\Models\Traits\RelationShip;


use App\Models\Account;
use App\Models\ActiveManager;
use App\Models\Question;
use App\Models\User;

trait ActivityRealtionShip
{
    public function account()
    {
        $this->belongsTo(Account::class, 'account_id');
    }

    public function users()
    {
        $this->hasMany(User::class, 'active_id');
    }

    public function questions()
    {
        $this->hasMany(Question::class,'active_id');
    }

    public function managers()
    {
        $this->hasMany(ActiveManager::class,'active_id');
    }
}