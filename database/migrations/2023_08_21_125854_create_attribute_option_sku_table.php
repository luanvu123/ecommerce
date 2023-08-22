<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeOptionSkuTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_option_sku', function (Blueprint $table) {
            $table->foreignId('sku_id')->constrained();
            $table->foreignId('attribute_option_id')->constrained();
            $table->primary(['sku_id', 'attribute_option_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_option_sku');
    }
}

