<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating words to users (Many-to-Many)
        Schema::create('user_word', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('word_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('word_id')->references('id')->on('words')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'word_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_word');
    }
}
