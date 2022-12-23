<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('languages')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('languages')->insert(array (
            0 =>
            array (
                'lang' => 'English', 
                'code' => 'en', 
                'flag' => 'uploads/languages/1639482174.png',
                'isActive' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
           1 =>
            array (
                'lang' => 'Arabic',
                'code' => 'ar', 
                'flag' => 'uploads/languages/1639489467.png',
                'isActive' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
