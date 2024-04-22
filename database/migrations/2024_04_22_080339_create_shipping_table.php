<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên phương thức vận chuyển
            $table->text('description')->nullable(); // Mô tả về phương thức vận chuyển (tùy chọn)
            $table->decimal('price', 15, 0); // Giá cước vận chuyển, có 15 chữ số tổng cộng và không có số thập phân
            $table->tinyInteger('status')->default(1); // Trạng thái của phương thức vận chuyển (ví dụ: 1 - active, 0 - inactive)
            
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
        Schema::dropIfExists('shippings');
    }
}

