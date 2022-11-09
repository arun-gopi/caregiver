<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
			$table->uuid('uuid')->index();
            $table->string('MRN',50)->nullable()->default('NULL');
            $table->string('first_name',100);
            $table->string('middle_name',100)->nullable();
            $table->string('last_name',100);
            $table->string('gender',10)->nullable();
            $table->string('email',150)->nullable();
            $table->string('mobile',100);
			$table->string('homephone',100)->nullable();
            $table->date('birthday');
			$table->text('address');
            $table->string('city',100);
            $table->string('ssn',100);
            $table->string('state',100);
			$table->string('zip',25);
            $table->string('country',100);
            $table->text('photo')->nullable();
            $table->boolean('isActive')->default(1)->comment('0 : Disabled');
			$table->string('pri_insurance',50)->nullable();
			$table->string('pri_insurance_id',50)->nullable();
			$table->string('sec_insurance',50)->nullable();
			$table->string('sec_insurance_id',50)->nullable();
            $table->string('emg_first_name',100)->nullable();
            $table->string('emg_last_name',100)->nullable();
            $table->string('emg_relationship',50)->nullable();
            $table->string('emg_email',150)->nullable();
            $table->string('emg_mobile',100);
			$table->string('emg_homephone',100)->nullable();
            $table->text('emg_address')->nullable();
            $table->string('emg_city',100)->nullable();
            $table->string('emg_state',100)->nullable();
			$table->string('emg_zip',50)->nullable();
            $table->string('emg_country',50)->nullable();
            $table->string('emg_IsCareGiver',10)->nullable();
            $table->string('emg_IsLegalSelected',10)->nullable();
            $table->string('emg_IsPatientSelected',10)->nullable();
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
