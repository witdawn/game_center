<?php

namespace App\Models;

class Question extends BaseModel
{
    public function getOptionsAttribute()
    {
        return unserialize($this->attributes['options']);
    }

    public function setOptionsAttribute($value)
    {
        return $this->attributes['options'] = serialize($value);
    }
}
