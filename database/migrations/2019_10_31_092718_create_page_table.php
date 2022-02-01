<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Menu
        Schema::create('pages', function(Blueprint $table){
            $table->increments('id');
            $table->string('url');
            $table->string('display_name');
            $table->integer('role_id')->unsigned();
            $table->integer('child_item')->unsigned();
            $table->integer('order')->unsigned()->nullable();
            $table->integer('active')->unsigned()->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
