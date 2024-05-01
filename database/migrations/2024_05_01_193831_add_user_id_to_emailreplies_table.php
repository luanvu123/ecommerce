<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToEmailrepliesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('emailreplies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Thêm trường user_id, cho phép giá trị NULL

            // Thêm foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('emailreplies', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Xóa foreign key trước khi xóa trường
            $table->dropColumn('user_id'); // Xóa trường user_id
        });
    }
}
