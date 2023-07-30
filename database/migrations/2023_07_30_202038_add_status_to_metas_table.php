<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMetasTable extends Migration
{
    public function up()
    {
        Schema::table('metas', function (Blueprint $table) {
            $table->integer('status')->default(1);
        });
    }

    public function down()
    {
        Schema::table('metas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

