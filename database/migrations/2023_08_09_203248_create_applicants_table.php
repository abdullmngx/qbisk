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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('application_number')->unique();
            $table->string('first_name');
            $table->string("middle_name")->nullable();
            $table->string("surname");
            $table->string("email");
            $table->date('dob')->nullable();
            $table->enum("gender", ['male', 'female', 'other'])->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('address')->nullable();
            $table->enum('religion', ['islam', 'christianity', 'other'])->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_occupation')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('health_status')->nullable();
            $table->string('health_status_description')->nullable();
            $table->enum('disablity', ['none', 'blind', 'deaf', 'dumb', 'handicapped', 'other'])->nullable();
            $table->string('blood_group')->nullable();
            $table->string("genotype")->nullable();
            $table->string("allergies")->nullable();
            $table->string('height')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger("term_id");
            $table->unsignedBigInteger("applied_section_id");
            $table->unsignedBigInteger('applied_form_id');
            $table->unsignedBigInteger('applied_arm_id');
            $table->unsignedBigInteger("section_id")->nullable();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->unsignedBigInteger('arm_id')->nullable();
            $table->enum('status', ['not admitted', 'admitted'])->default('not admitted');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
