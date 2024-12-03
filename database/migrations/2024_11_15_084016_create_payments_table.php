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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade'); // Linking to the specific medical record
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer', 'other'])->default('cash'); // Method of payment
            $table->decimal('amount', 10, 2); // Amount paid
            $table->decimal('discount', 5, 2)->nullable(); // Discount if any, specific to this payment
            $table->date('payment_date'); // Date of payment
            $table->enum('status', ['fully_paid', 'partially_paid', 'overdue'])->default('partially_paid'); // Payment status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
