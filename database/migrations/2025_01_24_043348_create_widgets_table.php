<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('url');
            $table->boolean('has_credentials')->default(false);
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->json('position');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
