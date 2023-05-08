<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_sets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')
                ->on('carts')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('set_id')->nullable();
            $table->foreign('set_id')->references('id')
                ->on('sets')->onUpdate('cascade')->onDelete('set null');

            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('cart_sets');
    }
}
