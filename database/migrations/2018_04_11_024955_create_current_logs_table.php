<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->nullable()->index()->comment('隶属活动');
            $table->integer('user_id')->index()->comment('用户id');
            $table->decimal('money')->default(0)->comment('提现金额');
            $table->tinyInteger('status')->comment('提现状态');
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
        Schema::dropIfExists('current_logs');
    }
}
