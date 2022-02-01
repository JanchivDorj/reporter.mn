<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //System code
        Schema::create('system_codes', function(Blueprint $table){
            $table->increments('id');
            $table->string('image')->nullable();
            $table->integer('active')->unsigned()->nullable();
            $table->string('system_name');
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
        Schema::dropIfExists('system_codes');
    }
}
