<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMessageAndPaymentIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Thêm cột message và paymentID vào bảng orders
            $table->string('message')->nullable();
            $table->string('paymentID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Xóa cột message và paymentID nếu tồn tại
            $table->dropColumn('message');
            $table->dropColumn('paymentID');
        });
    }
}

