<?php

namespace App\Models;

use App\Models\Traits\RelationShip\ActivityRealtionShip;

class Activity extends BaseModel
{
    use ActivityRealtionShip;

    public static function change_round($acitve_id)
    {
        $active = self::find($acitve_id);
        if ($active->question_index == 12 && $active->question_round < 3) {
            $active->question_round++;
        } else {
            $active->question_round = 1;
        }
        $active->question_index = 1;
        $active->save();
        QuestionUser::where('round_number', 0)->update(['round_number' => $active->question_round]);
    }
}
