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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id");
            $table->enum('owner_type', ['student', 'applicant']);
            $table->unsignedBigInteger("invoice_type_id");
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('form_id');
            $table->string('invoice_number');
            $table->string('payment_reference');
            $table->string("transaction_id");
            $table->float('amount');
            $table->enum('payment_status', ['pending', 'successful', 'failed']);
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
