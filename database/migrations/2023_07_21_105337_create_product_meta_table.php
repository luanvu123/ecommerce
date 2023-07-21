<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('meta_id');
            $table->text('meta_value')->nullable();
            $table->timestamps();

            // Khóa ngoại kết nối bảng product_meta với bảng products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Khóa ngoại kết nối bảng product_meta với bảng metas
            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_meta');
    }
}

