<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id');
            $table->text('text')->nullable();
            $table->tinyInteger('rype_result')->default(0);//тип результата 0 - колличестов правильных  ответов 1- колличестов   напранных баллов
            $table->integer('min_count')->default(0);//минимальное  колличество
            $table->integer('max_count')->nullable();//максимальное  колличество
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_tests');
    }
}
