<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            //usado para q el id sea positivo
            $table->unsignedBigInteger('user_id');
            //slug para q en el link haga referncia al titulo y sea unico link por cada post
            $table->string('title');
            $table->string('slug')->unique();
            //image nullable puede estar vacio sera un url
            $table->string('image')->nullable();
            //iframe sera para los videos o podcast
            $table->text('body');
            $table->text('iframe')->nullable();

            $table->timestamps();
            //conexion para referencia
            $table->foreign('user_id')->references('id')->on('users');
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
};
