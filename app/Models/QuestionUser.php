<?php

namespace App\Models;

class QuestionUser extends BaseModel
{
    //
    protected $fillable = [
        'round_number'
    ];

    public static function getWinners($active_id, $round_number)
    {
        $selects = ['openid', 'active_id', 'nickname', 'headimg', 'id'];
        return self::where('active_id', $active_id)->where('round_number', $round_number)->where('satatus', 1)->users()->select($selects)->get();
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function active()
    {
        return $this->belongsTo(Activity::class, 'active_id');
    }
}
