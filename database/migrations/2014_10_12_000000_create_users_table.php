<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_loaithanhvien');
            $table->string('username', 100)->unique();
            $table->string('name', 255);
            $table->string('avatar', 255)->nullable();
            $table->text('intro')->nullable();
            $table->string('background', 255)->nullable();
            $table->string('email', 180)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->boolean('status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
