<?php

namespace App\Models;


class Account extends BaseModel
{
    protected $fillable = [

    ];

    public function activies()
    {
        return $this->hasMany(Activity::class,'account_id');
    }

    /**
     * 密码修改器
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = sha1($value);
    }
}
