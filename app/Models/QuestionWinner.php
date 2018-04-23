<?php

namespace App\Models;

class QuestionWinner extends BaseModel
{
    protected $appends = [
        'headimg',
        'nickname',
        'openid',
    ];

    public static function getWinners($active_id, $round_number)
    {
        return self::where('active_id', $active_id)->where('round_number', $round_number)->get();
    }

    public function getHeadimgAttribute()
    {
        if(!$this->user)
            return '';
        return $this->user->headimg;
    }

    public function getNicknameAttribute()
    {
        if(!$this->user)
            return '';
        return $this->user->nickname;
    }

    public function getOpenidAttribute()
    {
        if(!$this->user)
            return '';
        return $this->user->openid;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function active()
    {
        return $this->belongsTo(Activity::class, 'active_id');
    }
}
