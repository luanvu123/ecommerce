<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceAndTotalAmountToOutgoingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outgoing_products', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outgoing_products', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('total_amount');
        });
    }
}

