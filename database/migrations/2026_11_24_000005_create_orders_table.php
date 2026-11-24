<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->string('delivery_city')->default('Dar es Salaam');
            $table->string('delivery_area');
            $table->text('delivery_address');
            $table->string('delivery_method')->default('Dar es Salaam Express');
            $table->decimal('delivery_fee', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total', 12, 2);
            $table->string('payment_method')->default('mpesa');
            $table->string('payment_status')->default('pending');
            $table->string('payment_reference')->nullable();
            $table->string('order_status')->default('pending');
            $table->text('notes')->nullable();
            $table->boolean('ordered_via_whatsapp')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
