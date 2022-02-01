<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //LOGS
        Schema::create('logs', function(Blueprint $table){
            $table->increments('id');
            $table->string('type');
            $table->text('description');
            $table->string('ip');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('page_name')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
