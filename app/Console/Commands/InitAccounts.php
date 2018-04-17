<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Activity;
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
        $active=new Activity();
        $active->account_id=$account->id;
        $active->question_round=1;
        $active->title='基础活动';
        $active->start_at=Carbon::now()->subMonth(3);
        $active->end_at=Carbon::now()->addYear(10);
        $active->screen_back='';
        $active->mobile_back='';
        $active->modules=$account->modules;
        $active->save();
        $this->info('初始化完毕');
    }
}
