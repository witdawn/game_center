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
}
