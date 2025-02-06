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
        Schema::create('vessel_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_title');
            $table->date('date_expiry');
            $table->string('attachment');
            $table->unsignedInteger('vessel_VslCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_documents');
    }
};
