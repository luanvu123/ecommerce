<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('phone_number_customer')->nullable();
            $table->string('address_customer')->nullable();
            $table->date('date_customer')->nullable();
            $table->string('avatar_customer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('phone_number_customer');
            $table->dropColumn('address_customer');
            $table->dropColumn('date_customer');
            $table->dropColumn('avatar_customer');
        });
    }
}
