<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('emp_id',50)->nullable()->default('NULL');
            $table->string('first_name',100)->default('');
            $table->string('middle_name',100)->nullable()->default('NULL');
            $table->string('last_name',100)->nullable()->default('NULL');
            $table->string('gender',10);
            $table->string('email',150);
            $table->string('mobile',20);
            $table->date('birthday')->nullable();
            $table->date('joined_date')->nullable();
            $table->text('address');
            $table->string('city',100);
            $table->string('state',100);
			$table->string('zip',100);
            $table->string('country',50);
            $table->text('photo')->nullable();
            $table->text('level')->nullable(); //Physician, Clinician,Staff
            $table->text('Title')->nullable(); //MD,DO,RN,Homehealth Aid,
            $table->boolean('isActive')->nullable();
            $table->string('Department',100);
            $table->string('Designation',100);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('employees');
    }
}
