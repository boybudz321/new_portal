<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('relatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seaman_id')->constrained('seafarers')->onDelete('cascade')->references('id');
            $table->string('relative_id')->nullable();
            $table->boolean('is_primary')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('sex')->nullable();
            $table->string('id_code')->nullable();
            $table->boolean('is_employed')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer_name')->nullable();
            $table->boolean('is_owwa')->nullable();
            $table->boolean('is_phil_health')->nullable();
            $table->string('lang_id')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('age')->nullable();
            $table->string('full_name')->nullable();
            $table->string('type_name')->nullable();
            $table->string('address_id')->nullable();
            $table->boolean('address_is_primary')->nullable();
            $table->string('address_name')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_county')->nullable();
            $table->string('country_id')->nullable();
            $table->string('address_postal_index')->nullable();
            $table->string('address_fax')->nullable();
            $table->string('address_email')->nullable();
            $table->string('address_phone')->nullable();
            $table->string('address_lang_id')->nullable();
            $table->text('full_address')->nullable();
            $table->string('address_country_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_icao_a2')->nullable();
            $table->string('country_icao_a3')->nullable();
            $table->string('country_icao_n3')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relatives');
    }
};
