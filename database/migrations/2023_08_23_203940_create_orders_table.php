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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->decimal('subtotal', 8, 2);
            $table->decimal('tva', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('nameOnCard')->nullable();
            $table->string('numberOnCard')->nullable();
            $table->string('expirationDate')->nullable();
            $table->enum('paymentMode', ['cash', 'card','paypal']);
            $table->enum('paymentStatus', ['due', 'paid']);
            $table->enum('orderStatus', ['pending', 'confirmed', 'completed', 'pickedup', 'canceled'])->default('confirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
