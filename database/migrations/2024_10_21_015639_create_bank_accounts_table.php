<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seaman_id')->constrained('seafarers')->onDelete('cascade')->references('id');
            $table->string('relative_id')->nullable();
            $table->string('beneficiary')->nullable();
            $table->string('beneficiary_id_code')->nullable();
            $table->text('beneficiary_address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_name_id')->nullable();
            $table->string('country_id')->nullable();
            $table->text('address')->nullable();
            $table->text('bank_details')->nullable();
            $table->string('bank_iban_code')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_sort_code')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('correspondent_bank')->nullable();
            $table->string('correspondent_bank_account')->nullable();
            $table->string('correspondent_bank_code')->nullable();
            $table->string('lang_id')->nullable();
            $table->string('status')->nullable();
            $table->string('status_name')->nullable();
            $table->boolean('is_mpo')->nullable();
            $table->boolean('is_primary')->nullable();
            $table->string('_check_sum')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_icao_a2')->nullable();
            $table->string('country_icao_a3')->nullable();
            $table->string('country_icao_n3')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
};
