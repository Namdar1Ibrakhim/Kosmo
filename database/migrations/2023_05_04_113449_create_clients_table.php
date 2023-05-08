<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone', 20)->unique();
            $table->string('name')->comment('Имя');
            $table->string('surname')->comment('Фамилия')->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('age')->nullable(false);
            $table->string('gender')->nullable(false);
            $table->string('remember_token', 100)->nullable(true);
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
        Schema::dropIfExists('clients');
    }
}
