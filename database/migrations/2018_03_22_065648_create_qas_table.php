<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('account_id')->nullable()->index()->comment('隶属账户');
            $table->string('title',128)->nullable()->comment('问题');
            $table->text('answers')->nullable()->comment('备选答案问题');
            $table->string('right')->nullable()->comment('正确答案');
            $table->string('score')->nullable()->comment('分值');
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
