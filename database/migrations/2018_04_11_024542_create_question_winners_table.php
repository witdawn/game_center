<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_winners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->nullable()->index()->comment('活动id');
            $table->integer('round_number')->nullable()->index()->comment('轮数');
            $table->integer('user_id')->nullable()->index()->comment('用户id');
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
        Schema::dropIfExists('question_winners');
    }
}
