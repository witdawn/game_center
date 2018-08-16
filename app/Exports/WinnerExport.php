<?php
/**
 * Created by PhpStorm.
 * User: an
 * Date: 18-8-16
 * Time: 上午9:52
 */

namespace App\Exports;

use App\Models\QuestionWinner;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class WinnerExport implements FromCollection
{
    private $active_id;
    private $round;

    public function __construct($active_id, $round)
    {
        $this->active_id = $active_id;
        $this->round = $round;
    }

    public function collection()
    {
        $winners = QuestionWinner::where('active_id', $this->active_id)->where('round_number', $this->round)->select('user_id')->get();
        $ids = [];
        foreach ($winners as $winner) {
            $ids[] = $winner->user_id;
        }
        return User::whereIn('id', $ids)->select(['nickname', 'phone'])->get();
    }
}