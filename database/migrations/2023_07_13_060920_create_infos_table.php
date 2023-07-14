<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('logo1')->nullable();
            $table->string('logo2')->nullable();
            $table->string('image_login')->nullable();
            $table->string('image_sighup')->nullable();
            $table->string('logo_hotdeals')->nullable();
            $table->string('title_hotdeals')->nullable();
            $table->string('logo_categories')->nullable();
            $table->string('title_categories')->nullable();
            $table->string('title2_categories')->nullable();
            $table->string('logo_dontmiss')->nullable();
            $table->string('title_dontmiss')->nullable();
            $table->string('title2_dontmiss')->nullable();
            $table->string('logo_thisweek')->nullable();
            $table->string('title_thisweek')->nullable();
            $table->string('title2_thisweek')->nullable();
            $table->string('logo_mostsold')->nullable();
            $table->string('title_mostsold')->nullable();
            $table->string('title2_mostsold')->nullable();
            $table->string('logo_whyus')->nullable();
            $table->string('title_whyus')->nullable();
            $table->string('title2_whyus')->nullable();
            $table->string('address_store')->nullable();
            $table->string('phone_store')->nullable();
            $table->string('email_store')->nullable();
            $table->text('careers')->nullable();
            $table->text('opening_hours')->nullable();
            $table->string('address_support')->nullable();
            $table->string('phone_support')->nullable();
            $table->string('youtube')->nullable();
            $table->string('title_download')->nullable();
            $table->string('copyright');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('infos');
    }
}
