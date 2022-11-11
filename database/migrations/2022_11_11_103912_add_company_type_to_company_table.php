<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyTypeToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('company_type')->comment('company type,0-homehealth 1-hospice')->nullable();
        });
        Schema::table('visit_types', function (Blueprint $table) {
            $table->string('company_type')->comment('company type,0-homehealth 1-hospice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('company_type');
        });
        Schema::table('visit_types', function (Blueprint $table) {
            $table->dropColumn('company_type');
        });
    }
}
