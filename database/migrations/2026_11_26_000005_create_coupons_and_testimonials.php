<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('coupons')) {
            Schema::create('coupons', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('type')->default('fixed'); // fixed, percentage
                $table->decimal('value', 12, 2);
                $table->decimal('min_order_amount', 12, 2)->default(0);
                $table->decimal('max_discount_amount', 12, 2)->nullable();
                $table->integer('usage_limit')->nullable();
                $table->integer('times_used')->default(0);
                $table->dateTime('starts_at')->nullable();
                $table->dateTime('expires_at')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('customer_name');
                $table->string('customer_role')->nullable(); // e.g. "Fitness Coach", "Corporate Executive", "Outdoor Enthusiast"
                $table->string('location')->default('Dar es Salaam');
                $table->text('comment');
                $table->integer('rating')->default(5);
                $table->string('avatar')->nullable();
                $table->boolean('is_featured')->default(true);
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('coupons');
    }
};
