<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLargePosterToPostersTable extends Migration
{
    public function up()
    {
        Schema::table('posters', function (Blueprint $table) {
            $table->integer('large_poster')->default(0);
        });
    }

    public function down()
    {
        Schema::table('posters', function (Blueprint $table) {
            $table->dropColumn('large_poster');
        });
    }
}
