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
            $table->unsignedBigInteger('contestant_id');
            $table->unsignedBigInteger('category_id');
            
            $table->string('session_id')->nullable();
            $table->text('webhook_payload')->nullable();
            $table->text('webhook_payload_customer')->nullable();
            $table->text('webhook_payload_payment_intent')->nullable();
            $table->string('stripe_customer_email', 500)->nullable();
            $table->string('stripe_payment_status');
            
            $table->timestamps();
            
            $table->foreign('contestant_id')->references('id')->on('contestants');
            $table->foreign('category_id')->references('id')->on('categories');
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
