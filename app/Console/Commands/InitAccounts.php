<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Activity;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InitAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init_account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成初始账号';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (Account::count('id') == 0) {
            $account = new Account();
            $account->account = 'anan6527';
            $account->password = 'admin666';
            $account->modules = serialize(['question']);
            $account->appid = '';
            $account->secret = '';
            $account->wxaccount = '';
            $account->wxid = '';
            $account->machid = '';
            $account->apisecret = '';
            $account->weixin_cert = '';
            $account->weixin_key = '';
            $account->save();
            $active = new Activity();
            $active->account_id = $account->id;
            $active->question_round = 1;
            $active->title = '基础活动';
            $active->start_at = Carbon::now()->subMonth(3);
            $active->end_at = Carbon::now()->addYear(10);
            $active->screen_back = '';
            $active->mobile_back = '';
            $active->modules = $account->modules;
            $active->save();
            $this->info('账号、活动初始化完毕');
        }
        $account = Account::first();
        $active = $account->activities()->first();
        $active->questions()->delete();
        if ($active->questions()->count('id') == 0) {
            for ($j = 1; $j < 4; $j++) {
                for ($i = 1; $i < 13; $i++) {
                    $first = rand(1, 9);
                    $seccond = rand(1, 9);
                    $answer = rand(1, 4);
                    $options = [];
                    $orders = [
                        1 => 'A',
                        2 => 'B',
                        3 => 'C',
                        4 => 'D',
                    ];
                    for ($m = 1; $m < 5; $m++) {
                        if ($m == $answer) {
                            $options[] = $orders[$m] . ':' . ($seccond * $first + $first);
                        } else {
                            $options[] = $orders[$m] . ':' . rand(80, 260);
                        }
                    }
                    $question = new Question();
                    $question->active_id = $active->id;
                    $question->round_number = $j;
                    $question->status = 1;
                    $question->title = '第' . $i . "题：$seccond*$first+$first=?";
                    $question->options = serialize($options);
                    $question->answer = $answer;
                    $question->score = 0;
                    $question->display_order = $i;
                    $question->save();
                    $this->info('初始化第' . $j . '轮第' . $i . '题完毕');
                }
                $this->info('初始化第' . $j . '轮所有题木目完毕');
            }
        }


    }
}
