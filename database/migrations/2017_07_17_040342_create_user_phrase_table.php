<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPhraseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating phrases to users (Many-to-Many)
        Schema::create('user_phrase', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('phrase_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('phrase_id')->references('id')->on('phrases')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'phrase_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_phrase');
    }
}
