<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tr_user_id')->index()->default(0);
            $table->integer('tr_total')->default(0);
            $table->string('tr_note')->nullable();
            $table->string('tr_receiver')->nullable();
            $table->string('tr_receiver_address')->nullable();
            $table->string('tr_send_phone')->nullable();
            $table->string('tr_receiver_phone')->nullable();
            $table->string('tr_handler')->nullable();   ///người xử lý
            $table->string('tr_shipper')->nullable();  ///người giao hàng
            $table->string('tr_email')->nullable();
            $table->tinyInteger('tr_status')->index()->default(0);

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
        Schema::dropIfExists('transactions');
    }
}
