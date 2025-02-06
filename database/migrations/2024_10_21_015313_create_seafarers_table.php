<?php

use App\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seafarers', function (Blueprint $table) {
            $table->id();
            $table->string('manual_id')->nullable();
            $table->string('old_id')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('online_set_date')->nullable();
            $table->date('online_date')->nullable();
            $table->dateTime('online_datetime')->nullable();
            $table->date('client_date')->nullable();
            $table->string('rank_id')->nullable();
            $table->string('vessel_id')->nullable();
            $table->string('photo_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('citizenship_id')->nullable();
            $table->string('taxation_country_id')->nullable();
            $table->string('taxation_id_code')->nullable();
            $table->string('status')->nullable();
            $table->string('surname')->nullable();
            $table->string('name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('calling_name')->nullable();
            $table->string('national_full_name')->nullable();
            $table->string('child_cnt')->nullable();
            $table->text('fast_note')->nullable();
            $table->text('fast_note2')->nullable();
            $table->integer('age')->nullable();
            $table->string('pp_pob')->nullable();
            $table->date('pp_dob')->nullable();
            $table->string('pp_id_code')->nullable();
            $table->string('pp_country_id')->nullable();
            $table->string('primary_office_id')->nullable();
            $table->string('primary_bank_id')->nullable();
            $table->string('primary_address_id')->nullable();
            $table->text('_check_sum')->nullable();
            $table->string('primary_email')->nullable();
            $table->boolean('not_sms_event')->nullable();
            $table->boolean('not_email_event')->nullable();
            $table->boolean('is_unsubscribe')->nullable();
            $table->text('primary_address')->nullable();
            $table->string('primary_postal_index')->nullable();
            $table->string('primary_mobile')->nullable();
            $table->string('primary_airport')->nullable();
            $table->string('primary_relative_id')->nullable();
            $table->string('primary_contact_id')->nullable();
            $table->string('seniority_id')->nullable();
            $table->integer('seniority_days')->nullable();
            $table->decimal('seniority_months', 8, 2)->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_id')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('curr_location')->nullable();
            $table->date('curr_location_date')->nullable();
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('_r_id')->nullable();
            $table->string('rank_name')->nullable();
            $table->string('rank_short_name')->nullable();
            $table->string('rank_long_name')->nullable();
            $table->string('rank_export_id')->nullable();
            $table->string('status_name')->nullable();
            $table->string('status_export_id')->nullable();
            $table->string('country_code')->nullable();
            $table->string('pp_country_code')->nullable();
            $table->string('taxation_country_code')->nullable();
            $table->string('pp_country_name')->nullable();
            $table->string('taxation_country_name')->nullable();
            $table->string('citizenship_name')->nullable();
            $table->string('office_name')->nullable();
            $table->string('office_registered_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('onboard_emp_id')->nullable();
            $table->string('joining_emp_id')->nullable();
            $table->string('planned_emp_id')->nullable();
            $table->string('last_employment_state')->nullable();
            $table->date('last_employment_off_date')->nullable();
            $table->string('last_vessel_name')->nullable();
            $table->string('last_vessel_id')->nullable();
            $table->string('last_client_name')->nullable();
            $table->string('available')->nullable();
            $table->string('vessel_name')->nullable();
            $table->string('last_employment_id')->nullable();
            $table->string('last_contract_id')->nullable();
            $table->string('last_deployment_id')->nullable();
            $table->text('avatar')->default('');
            $table->text('esignature')->default('');
            $table->foreignIdFor(Company::class)->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seafarers');
    }
};
