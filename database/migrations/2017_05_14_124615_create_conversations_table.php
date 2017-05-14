<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->text('body');
	        $table->timestamp('last_reply')->nullable();
            $table->timestamps();
	
	        $table->foreign('parent_id')->references('id')->on('conversations')->onDelete('cascade');
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        
        });
        
        
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
