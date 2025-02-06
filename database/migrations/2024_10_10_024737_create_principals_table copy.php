<?php

use App\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('principals', function (Blueprint $table) {
            $table->id();
            $table->string('PrinCode', 100)->default('')->nullable();
            $table->string('Abbrv', 100)->default('')->nullable();
            $table->string('Name', 100)->default('')->nullable();
            $table->string('Addr', 100)->nullable();
            $table->string('CntryCode', 100)->nullable();
            $table->string('Phone', 100)->default('')->nullable();
            $table->string('Telefax', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->unsignedTinyInteger('ActCode')->default(0)->nullable();

            $table->foreignIdFor(Company::class)->onDelete('set null');
            $table->index('PrinCode', 'x01_principals');
        });
    }

    public function down()
    {
        Schema::dropIfExists('principals');
    }
};
