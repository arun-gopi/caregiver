<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // User::factory(10)->create();
        $this->call(PatientSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
