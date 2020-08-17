<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500)->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('time_limit')->nullable();
            $table->integer('category_id')->nullable();//категории 
            $table->integer('company_id')->nullable();//категории 
            $table->tinyInteger('types_test')->nullable();//1-опрос 2- проффесиональный 3-психологический
            $table->integer('create_user_id')->nullable();
            $table->tinyInteger('skip')->default(1);//пропускать вопросы 0- не пропускать 1- пропускать
            $table->tinyInteger('revers')->default(1);//повторять вопросы 0 - не повторять вопросы 1 - вповторять
            $table->tinyInteger('private')->default(0);//0-приватный 1-публичный
            $table->tinyInteger('question_order')->default(0);//порядок вопросов 0- в порядке расположения  1 случайный
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
        Schema::dropIfExists('tests');
    }
}
