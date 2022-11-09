<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidscreeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covidscreenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Patient_id')->references('id')->on('patients');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->foreignId('form_id')->references('id')->on('hha_forms')->nullable();
            $table->dateTime('evaldate')->nullable();
            $table->boolean('pt_istravelled')->nullable();
            $table->boolean('pt_symptoms')->nullable();
            $table->boolean('pt_closecontact')->nullable();
            $table->boolean('pt_diagnosedc19')->nullable();
            $table->boolean('pt_risklevel')->nullable();
            $table->string('pt_temperature',10)->nullable();
            $table->string('pt_comment',250)->nullable();
            $table->boolean('emp_istravelled')->nullable();
            $table->boolean('emp_symptoms')->nullable();
            $table->boolean('emp_closecontact')->nullable();
            $table->boolean('emp_diagnosedc19')->nullable();
            $table->boolean('emp_risklevel')->nullable();
            $table->string('emp_temperature',10)->nullable();
            $table->string('emp_comment',250)->nullable();
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
        Schema::dropIfExists('covidscreenings');
    }
}
