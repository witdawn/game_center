<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->nullable()->index()->comment('隶属账户');
            $table->string('nickname',64)->nullable()->comment('微信昵称');
            $table->string('openid', 128)->nullable()->comment('微信openid');
            $table->string('headimg', 512)->nullable()->comment('微信头像');
            $table->string('name', 32)->nullable()->comment('姓名');
            $table->string('phone', 16)->nullable()->comment('电话');
            $table->boolean('sex')->nullable()->comment('性别 0女 1 男');
            $table->boolean('status')->nullable()->default(1)->comment('状态 0禁用 1启用');
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
        Schema::dropIfExists('users');
    }
}
