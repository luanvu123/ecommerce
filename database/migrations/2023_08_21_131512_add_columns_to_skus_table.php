<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSkusTable extends Migration
{
    public function up()
    {
        Schema::table('skus', function (Blueprint $table) {
            $table->integer('stock')->default(0);
            $table->text('images')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
        });
    }

    public function down()
    {
        Schema::table('skus', function (Blueprint $table) {
            $table->dropColumn('stock');
            $table->dropColumn('images');
            $table->dropColumn('status');
        });
    }
}

