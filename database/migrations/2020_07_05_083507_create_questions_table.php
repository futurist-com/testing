<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id');
            $table->text('text')->nullable();
            $table->string('image', 500)->nullable();
            $table->string('video_link', 500)->nullable();
            $table->integer('ball')->nullable(); //колличество балов  за правильный ответ
            $table->smallInteger('pn')->nullable(); //порядковый  номер
            $table->tinyInteger('type_question')->nullable();//тип впороса
            /**
             * 1- выбор правильного ответа одного - radio buttun 
             * 2 -  выбор правильных ответов несколько - checkdox
             * 3 -  правильный послеовательность ответов реализация
             * 4 - текст
             */
            $table->softDeletes();
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
        Schema::dropIfExists('questions');
    }
}
