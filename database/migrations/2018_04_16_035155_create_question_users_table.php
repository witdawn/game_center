<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->nullable()->index()->comment('活动id');
            $table->integer('user_id')->nullable()->index()->comment('用户id');
            $table->integer('round_number')->nullable()->index()->comment('轮数');
            $table->string('client_id',16)->nullable()->index()->comment('socket id');
            $table->tinyInteger('status')->nullable()->index()->comment('状态 0 淘汰 1未淘汰');
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
        Schema::dropIfExists('question_users');
    }
}
