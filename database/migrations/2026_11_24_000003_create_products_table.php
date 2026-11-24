<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->string('pack_size')->default('100g');
            $table->decimal('price', 12, 2);
            $table->decimal('promo_price', 12, 2)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->json('weight_options')->nullable();
            $table->integer('stock')->default(50);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->text('ingredients')->nullable();
            $table->json('nutritional_info')->nullable();
            $table->text('storage_instructions')->nullable();
            $table->json('certifications')->nullable();
            $table->json('badges')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
