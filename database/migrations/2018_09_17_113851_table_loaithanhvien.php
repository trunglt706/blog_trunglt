<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableLoaithanhvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaithanhviens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 180)->unique();
            $table->string('name');
            $table->text('intro')->nullable();
            $table->integer('mark')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('loaithanhviens');
    }
}
