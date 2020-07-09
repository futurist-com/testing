<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('question_id');
            $table->text('text');
            $table->integer('pn')->nullable();
            $table->tinyInteger('valid')->nullable();//правильный ответ, если необходим  правильный порядок то записываем сюда поряядковаый номер
            $table->string('image', 500)->nullable();// может быть картинок а не тестом картинка должна быть стандартной
            $table->integer('ball')->nullable();
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
        Schema::dropIfExists('answer_variants');
    }
}
