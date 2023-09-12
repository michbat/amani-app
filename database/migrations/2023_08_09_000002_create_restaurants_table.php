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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('gsm')->nullable();
            $table->string('email');
            $table->string('roadName');
            $table->integer('number');
            $table->string('postalCode');
            $table->string('city');
            $table->text('aboutUs');
            $table->text('reglement')->nullable();
            $table->string('facebookLink')->nullable();
            $table->string('twitterLink')->nullable();
            $table->string('instagramLink')->nullable();
            $table->boolean('opened')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
