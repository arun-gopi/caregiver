<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHhaFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hha_forms', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->foreignId('Patient_id')->references('id')->on('patients');
            $table->foreignId('Employee_id')->references('id')->on('employees');
            $table->foreignId('supervisor_id')->references('id')->on('employees')->nullable();
            $table->string('visit_type')->nullable();
            $table->string('visit_location')->nullable();
            $table->dateTime('visitintime')->nullable();
            $table->dateTime('visitouttime')->nullable();
            $table->string('unit',10)->nullable();
            $table->string('HCPCS',10)->nullable();
            $table->text('Comment')->nullable();
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
        Schema::dropIfExists('hha_forms');
    }
}
