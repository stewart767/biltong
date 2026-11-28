<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            }
            if (!Schema::hasColumn('orders', 'coupon_code')) {
                $table->string('coupon_code')->nullable()->after('subtotal');
                $table->decimal('discount_amount', 12, 2)->default(0)->after('coupon_code');
            }
        });

        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->string('transaction_reference')->unique()->nullable();
                $table->string('payment_method'); // mpesa, airtel, tigo, halopesa, bank, cod
                $table->decimal('amount', 12, 2);
                $table->string('currency')->default('TZS');
                $table->string('status')->default('pending'); // pending, verified, failed, refunded
                $table->string('sender_phone')->nullable();
                $table->string('sender_name')->nullable();
                $table->text('gateway_response')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('deliveries')) {
            Schema::create('deliveries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->string('carrier')->nullable(); // Coy Express, EMS, Kilimanjaro Courier, etc.
                $table->string('tracking_number')->nullable();
                $table->string('status')->default('pending'); // pending, assigned, dispatched, delivered, failed
                $table->string('rider_name')->nullable();
                $table->string('rider_phone')->nullable();
                $table->timestamp('dispatched_at')->nullable();
                $table->timestamp('delivered_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
        Schema::dropIfExists('payments');
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'coupon_code', 'discount_amount']);
        });
    }
};
