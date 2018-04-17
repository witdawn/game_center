<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->nullable()->comment('账号id');
            $table->tinyInteger('question_round')->nullable()->default(1)->comment('答题游戏所在的轮数');
            $table->string('title', 64)->nullable()->comment('活动主题');
            $table->date('start_at')->nullable()->comment('开始时间');
            $table->date('end_at')->nullable()->comment('开始时间');
            $table->string('screen_back', 256)->nullable()->comment('大屏幕背景');
            $table->string('mobile_back', 256)->nullable()->comment('手机背景');
            $table->text('modules')->nullable()->comment('开通的模块');
            $table->string('appid', 64)->nullable()->comment('appid');
            $table->string('secret', 64)->nullable()->comment('secret');
            $table->string('wxaccount', 64)->nullable()->comment('微信账号');
            $table->string('wxid', 64)->nullable()->comment('微信id');
            $table->string('machid', 64)->nullable()->comment('商户id');
            $table->string('apisecret', 64)->nullable()->comment('api密码');
            $table->string('weixin_cert', 128)->nullable()->comment('证书');
            $table->string('weixin_key', 64)->nullable()->comment('密钥');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
