<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('front');
            $table->tinyInteger('frontmarkup')->default(false);
            $table->text('back')->nullable();
            $table->tinyInteger('backmarkup')->default(false);
            $table->integer('order')->unsigned();
            $table->bigInteger('deck_id')->unsigned()->nullable();
            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('cardtype_id')->unsigned()->nullable();
            $table->foreign('cardtype_id')->references('id')->on('cardtypes')->onDelete('cascade');
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
        Schema::dropIfExists('cards');
    }
}
