<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pt_admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Patient_id')->references('id')->on('patients');
            $table->date('admissiondate');
            $table->date('dischargedate');
            $table->date('notes');
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
        Schema::dropIfExists('pt_admissions');
    }
}
