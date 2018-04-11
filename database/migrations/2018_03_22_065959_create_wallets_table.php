<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->nullable()->index()->comment('隶属活动');
            $table->integer('user_id')->index()->comment('用户id');
            $table->decimal('balance')->default(0)->comment('余额');
            $table->tinyInteger('left_times')->default(3)->comment('剩余提现次数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
