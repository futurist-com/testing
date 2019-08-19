<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telefon', 50)->nullable();
            $table->text('description')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('post_id')->unsigned()->nullable();
            $table->string('specialty', 100)->nullable();
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
        Schema::dropIfExists('workers');
    }
}
