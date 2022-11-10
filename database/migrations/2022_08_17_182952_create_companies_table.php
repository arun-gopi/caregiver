<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->text('company_name');
            $table->text('slug');
            $table->text('address')->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('email',150)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('NPI',20)->nullable();
            $table->string('TIN',20)->nullable();
            $table->string('MedicareID',20)->nullable();
            $table->string('MedicaidID',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('website',20)->nullable();
            $table->text('timezone')->nullable();
            $table->text('logo')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('companies');
    }
}
