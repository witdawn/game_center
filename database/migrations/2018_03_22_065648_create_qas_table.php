<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->nullable()->index()->comment('隶属活动');
            $table->integer('round_number')->nullable()->index()->comment('轮数');
            $table->string('title', 128)->nullable()->comment('问题');
            $table->text('options')->nullable()->comment('备选答案问题');
            $table->string('answer', 64)->nullable()->comment('正确答案');
            $table->integer('score')->nullable()->comment('分值');
            $table->tinyInteger('display_order')->nullable()->comment('排序,升序');
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
        Schema::dropIfExists('qas');
    }
}
