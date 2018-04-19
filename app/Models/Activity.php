<?php

namespace App\Models;

use App\Models\Traits\RelationShip\ActivityRealtionShip;

class Activity extends BaseModel
{
    use ActivityRealtionShip;

    public static function change_round($id, $round_number)
    {
        $active = self::find($id);
        $active->question_round = $round_number;
        $active->question_index = 1;
        $active->save();
        QuestionUser::where('round_number',0)->update(['round_number'=>$round_number]);
    }
}
