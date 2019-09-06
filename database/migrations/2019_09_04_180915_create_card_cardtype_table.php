<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardCardtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_card_type', function (Blueprint $table) {
            $table->bigInteger('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            $table->bigInteger('card_type_id')->unsigned();
            $table->foreign('card_type_id')->references('id')->on('card_types')->onDelete('cascade');

            $table->primary(array('card_id', 'card_type_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_card_type');
    }
}
