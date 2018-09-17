<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableBaiviet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baiviets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_danhmuc');
            $table->string('username');
            $table->string('slug', 180)->unique();
            $table->string('name');
            $table->text('intro')->nullable();
            $table->string('background');
            $table->text('content');
            $table->string('thumn');
            $table->integer('view')->default(0);
            $table->integer('like')->default(0);
            $table->boolean('status')->default(0);
            $table->string('keyword');
            $table->boolean('important')->default(0);
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
        Schema::dropIfExists('baiviets');
    }
}
