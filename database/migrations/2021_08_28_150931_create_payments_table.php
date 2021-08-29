<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('tran_id')->unique();
            $table->string('val_id')->nullable();
            $table->integer('amount');
            $table->string('card_type')->nullable();
            $table->integer('store_amount')->default(0);
            $table->string('bank_tran_id')->nullable();
            $table->string('status')->default('PENDING');
            $table->timestamp('tran_date')->useCurrent();
            $table->string('error')->nullable();
            $table->string('currency')->default('BDT');
            $table->string('risk_title')->nullable();
            $table->string('gateway_url', 320);
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
        Schema::dropIfExists('payments');
    }
}
