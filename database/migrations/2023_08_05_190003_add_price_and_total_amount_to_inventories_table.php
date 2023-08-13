<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('inventories', function (Blueprint $table) {
        $table->decimal('price', 10, 2)->after('quantity')->nullable();
        $table->decimal('total_amount', 10, 2)->after('price')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            //
        });
    }
};
