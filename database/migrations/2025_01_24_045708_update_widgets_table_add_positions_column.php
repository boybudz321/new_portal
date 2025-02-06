<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->integer('position_x')->default(0)->after('user_id');
            $table->integer('position_y')->default(0)->after('position_x');
            $table->dropColumn('position');
        });
    }

    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn(['position_x', 'position_y']);
        });
    }
};
