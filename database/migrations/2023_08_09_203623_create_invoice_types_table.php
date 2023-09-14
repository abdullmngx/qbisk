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
        Schema::create('invoice_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("session_id")->nullable();
            $table->unsignedBigInteger("term_id")->nullable();
            $table->unsignedBigInteger("section_id")->nullable();
            $table->unsignedBigInteger("form_id")->nullable();
            $table->unsignedBigInteger("arm_id")->nullable();
            $table->unsignedBigInteger("payment_category_id");
            $table->enum("owner_type", ['student', 'applicant']);
            $table->string('name');
            $table->float('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_types');
    }
};
