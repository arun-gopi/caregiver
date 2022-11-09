<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeboundstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('homeboundstatuses', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('patient_id')->unsigned(); 
            $table->date('ReferralDate');
            $table->text('Reason');
            $table->text('Diagnosis');
            $table->text('ClinicalFindings');
            $table->text('ServiceRequested');
            $table->text('Notes');
            $table->timestamps();
        });

        Schema::table('homeboundstatuses', function($table) {
            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homeboundstatuses');
    }
}
