<?php

use App\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->increments('vessel_id');
            $table->string('VslCode', 100)->default('');
            $table->string('PrinCode', 45)->nullable();
            $table->integer('SortCode')->nullable();
            $table->string('Name', 100);
            $table->string('VslTypeCode', 100)->nullable();
            $table->string('OffNbr', 100)->nullable();
            $table->string('PortofReg', 100)->default('');
            $table->string('Classf', 100)->nullable();
            $table->string('YearBuilt', 100)->nullable();
            $table->string('GrossTon', 100)->nullable();
            $table->string('DeadWt', 100)->nullable();
            $table->string('NetTon', 100)->nullable();
            $table->string('EngType', 100)->default('');
            $table->string('EngPower', 100)->nullable();
            $table->string('OwnerCode', 100)->nullable();
            $table->unsignedTinyInteger('ActCode')->default(0);
            $table->string('photo_directory', 200)->default('');
            $table->string('avatar', 200)->default('');
            $table->string('flag2', 50)->default('');
            $table->dateTime('date_modified')->nullable();
            $table->unsignedInteger('modified_by')->default(0);
            $table->dateTime('sync_stamp')->nullable();
            $table->unsignedInteger('synced_by')->default(0);
            $table->dateTime('date_inserted')->nullable();
            $table->unsignedInteger('inserted_by')->default(0);
            $table->integer('risk_profile')->nullable();
            $table->date('risk_date')->nullable();
            $table->string('risk_attachment', 500)->nullable();
            $table->string('ship_size', 20)->nullable();
            $table->string('right_ship', 15)->nullable();
            $table->string('emission_rate', 15)->nullable();
            $table->foreignIdFor(Company::class)->onDelete('set null');
            $table->index('VslCode');
            $table->index('VslCode', 'x01_vessels');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vessels');
    }
};
