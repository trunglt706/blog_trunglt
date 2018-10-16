<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_nap')->comment('Id người nạp');
            $table->integer('id_nhan')->comment('Id người nhận');
            $table->string('developer_trans_id');
            $table->double('amount', 12, 2);
            $table->boolean('status')->default(2)->comment('0-Failure | 1-Success | 2 - Pending');
            $table->string('note');
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
        Schema::dropIfExists('payment');
    }
}
