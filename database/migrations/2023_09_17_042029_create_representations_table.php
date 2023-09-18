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
        Schema::create('representations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('show_id')->constrained('shows')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('representationDate');
            $table->time('startTime');
            $table->time('endTime');
            $table->boolean('canceled')->default(false);
            $table->boolean('canceledThroughShow')->default(false);
            $table->boolean('isExpired')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representations');
    }
};
