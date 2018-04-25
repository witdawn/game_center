<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 32)->nullable()->index()->unique()->comment('用户名');
            $table->string('password', 64)->nullable()->comment('密码');
            $table->text('modules')->nullable()->comment('开通的模块');
            $table->tinyInteger('wx_type')->nullable()->default(0)->comment('微信类型 0微信服务号 1微信企业号');
            $table->string('appid', 64)->nullable()->comment('appid');
            $table->string('appsecret', 64)->nullable()->comment('secret');
            $table->string('agent_id', 64)->nullable()->comment('agent_id');
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
        Schema::dropIfExists('systems');
    }
}
