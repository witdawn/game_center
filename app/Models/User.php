<?php

namespace App\Models;

class User extends BaseModel
{
    protected static $params = [
        [
            'key'     => 'nickname',
            'default' => '',
        ],
        [
            'key'     => 'openid',
            'default' => '',
        ],
        [
            'key'     => 'name',
            'default' => '',
        ],
        [
            'key'     => 'phone',
            'default' => '',
        ],
        [
            'key'     => 'sex',
            'default' => 0,
        ],
        [
            'key'     => 'status',
            'default' => 1,
        ]

    ];

    public static function add($userinfo)
    {
        $user = new self;
        $user->active_id = session('game_active')['id'];
        foreach (self::$params as $param) {
            $key = $param['key'];
            $user->$key = isset($userinfo[$key]) ? $userinfo[$key] : $param['default'];
        }
        $user->headimg = $userinfo['headimgurl'];
        $user->save();
        return $user;
    }

    public function questionRound()
    {
        return $this->hasMany(QuestionUser::class, 'user_id');
    }
}
