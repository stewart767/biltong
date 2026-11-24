<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wholesale_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('contact_person');
            $table->string('phone');
            $table->string('email');
            $table->string('business_type'); // Supermarket, Hotel/Lodge, Gym, Retailer, Bar/Lounge, Distributor, Exporter, Other
            $table->string('estimated_quantity');
            $table->string('delivery_location')->nullable();
            $table->text('message');
            $table->string('status')->default('new'); // new, contacted, negotiating, approved, closed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wholesale_enquiries');
    }
};
