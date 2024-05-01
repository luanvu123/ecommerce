<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('emailreplies')) {
            Schema::create('emailreplies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('contact_id');
                $table->string('to');
                $table->string('subject');
                $table->text('message');
                $table->string('attachment')->nullable();
                $table->timestamps();

                $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('emailreplies');
    }
};
