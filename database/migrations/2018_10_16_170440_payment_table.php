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
            $table->string('id_nap')->nullable()->comment('Id người nạp');
            $table->string('id_nhan')->nullable()->comment('Id người nhận');
            $table->string('developer_trans_id');
            $table->string('phone')->nullable();
            $table->double('amount', 12, 2);
            $table->boolean('status')->default(2)->comment('0-Failure | 1-Success | 2 - Pending');
            $table->string('note')->nullable();
            $table->string('auth')->default('auth');
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
