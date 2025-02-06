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
        Schema::table('seafarers', function (Blueprint $table) {
            // Check if the column exists first
            if (!Schema::hasColumn('seafarers', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seafarers', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['user_id']);
            // Then drop the column
            $table->dropColumn('user_id');
        });
    }
};
