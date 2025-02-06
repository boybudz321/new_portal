<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seaman_id')->constrained('seafarers')->onDelete('cascade')->references('id');
            $table->string('cert_id')->nullable();
            $table->integer('expire_days')->nullable();
            $table->integer('expire_months')->nullable();
            $table->string('expiry_status')->nullable();
            $table->date('to_date')->nullable();
            $table->date('from_date')->nullable();
            $table->boolean('is_valid')->nullable();
            $table->boolean('is_flag')->nullable();
            $table->boolean('is_unlimited')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('issuer')->nullable();
            $table->string('issuer_country')->nullable();
            $table->boolean('is_archive')->nullable();
            $table->boolean('is_required')->nullable();
            $table->boolean('is_verified')->nullable();
            $table->text('notes')->nullable();
            $table->string('_check_sum')->nullable();
            $table->string('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->boolean('is_confidential')->nullable();
            $table->string('issuer_country_name')->nullable();
            $table->string('cert_stcw_code')->nullable();
            $table->string('cert_export_id')->nullable();
            $table->string('cert_name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certifications');
    }
};
