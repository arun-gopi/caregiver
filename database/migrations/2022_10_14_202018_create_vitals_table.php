<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Patient_id')->references('id')->on('patients');
            $table->foreignId('form_id')->references('id')->on('hha_forms')->nullable();
            $table->string('BPLying',50)->nullable();
            $table->string('BPSitting',50)->nullable();
            $table->string('BPStanding',50)->nullable();
            $table->string('Temperature',50)->nullable();
            $table->string('Apical_Pulse',50)->nullable();
            $table->string('Radial_Pulse',50)->nullable();
            $table->string('Respirations',50)->nullable();
            $table->string('Weight',50)->nullable();
            $table->boolean('BPLeft')->nullable();
            $table->boolean('BPRight')->nullable();
            $table->boolean('OutofRange')->nullable();
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
        Schema::dropIfExists('vitals');
    }
}
