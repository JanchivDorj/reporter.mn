<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //POSTS
        Schema::create('posts', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->text('more_text');
            $table->integer('active')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('title_img')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamps();
            $table->integer('post_img')->unsigned()->nullable();
            $table->integer('post_count')->unsigned()->nullable();
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
        Schema::dropIfExists('posts');
    }
}
