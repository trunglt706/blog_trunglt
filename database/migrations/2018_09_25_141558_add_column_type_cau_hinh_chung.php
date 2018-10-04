<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTypeCauHinhChung extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cauhinhchungs', function (Blueprint $table) {
            $table->string('type')->default('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cauhinhchungs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
