<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->string('background_color', 7)->nullable();
            $table->string('border_color', 7)->nullable();
        });
    }

    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn(['background_color', 'border_color']);
        });
    }
};
