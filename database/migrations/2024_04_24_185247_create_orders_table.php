<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('recipient_address');
            $table->string('recipient_email');
            $table->decimal('total_price', 10, 2);
            $table->string('status');
            $table->string('payment_method');
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('shipping_id')->references('id')->on('shippings');
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

