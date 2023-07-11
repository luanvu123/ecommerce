<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('hot_deals')->nullable();
            $table->string('image_product2')->nullable();
            $table->string('image_product3')->nullable();
            $table->string('image_product4')->nullable();
            $table->string('image_product5')->nullable();
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('hot_deals');
            $table->dropColumn('image_product2');
            $table->dropColumn('image_product3');
            $table->dropColumn('image_product4');
            $table->dropColumn('image_product5');
            $table->dropColumn('status');
        });
    }
}
