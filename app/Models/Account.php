<?php

namespace App\Models;


class Account extends BaseModel
{
    protected $fillable = [

    ];

    protected $hidden=[
        'password'
    ];

    public function activities()
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
