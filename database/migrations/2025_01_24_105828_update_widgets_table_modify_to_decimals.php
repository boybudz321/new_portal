<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->decimal('position_x', 8, 2)->change();
            $table->decimal('position_y', 8, 2)->change();
            $table->decimal('width', 8, 2)->change();
            $table->decimal('height', 8, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->integer('position_x')->change();
            $table->integer('position_y')->change();
            $table->integer('width')->change();
            $table->integer('height')->change();
        });
    }
};
