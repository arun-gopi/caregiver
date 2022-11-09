<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pt_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Patient_id')->references('id')->on('patients');
            $table->string('ICD10');
            $table->string('ICD10Description')->nullable();
            $table->integer('primarydiag')->nullable();
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
        Schema::dropIfExists('pt_diagnoses');
    }
}
