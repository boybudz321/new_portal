<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->boolean('requires_login');
            // $table->dropColumn('has_credentials');
            // $table->boolean('has_credentials')->default(false);
        });
    }

    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            // $table->dropColumn('requires_login');
            $table->dropColumn('has_credentials');
        });
    }
};
