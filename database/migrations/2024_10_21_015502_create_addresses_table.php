<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('reference_type')->nullable();
            $table->foreignId('referencing_id')->constrained('seafarers')->onDelete('cascade')->references('id');
            $table->boolean('is_primary')->nullable();
            $table->string('name')->nullable();
            $table->string('station')->nullable();
            $table->string('city')->nullable();
            $table->string('country_id')->nullable();
            $table->string('postal_index')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->boolean('not_email_event')->nullable();
            $table->boolean('not_sms_event')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('county')->nullable();
            $table->string('skype_name')->nullable();
            $table->string('lang_id')->nullable();
            $table->string('airport')->nullable();
            $table->string('airport_id')->nullable();
            $table->string('_check_sum')->nullable();
            $table->string('airport_code')->nullable();
            $table->string('airport_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_icao_a2')->nullable();
            $table->string('country_icao_a3')->nullable();
            $table->string('country_icao_n3')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
