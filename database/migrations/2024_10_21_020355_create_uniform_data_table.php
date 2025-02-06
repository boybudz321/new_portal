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
        Schema::create('uniform_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seaman_id')->constrained('seafarers')->onDelete('cascade')->references('id');
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('chest', 5, 2)->nullable();
            $table->string('boilersuit')->nullable();
            $table->string('boots')->nullable();
            $table->string('sweater')->nullable();
            $table->string('trousers')->nullable();
            $table->string('pilot_shirt')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->string('eyes_color')->nullable();
            $table->string('blood_rhesus')->nullable();
            $table->string('blood_type')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->string('religion_name')->nullable();
            $table->string('measure_type')->nullable();
            $table->string('insurance_name')->nullable();
            $table->string('membership_no')->nullable();
            $table->string('medical_plan')->nullable();
            $table->boolean('main_member')->nullable();
            $table->string('contact_no')->nullable();
            $table->date('insurance_from_date')->nullable();
            $table->date('insurance_to_date')->nullable();
            $table->text('chronic_illness')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medication')->nullable();
            $table->boolean('smoking')->nullable();
            $table->boolean('drinking')->nullable();
            $table->text('tattoos')->nullable();
            $table->string('hair_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniform_data');
    }
};
