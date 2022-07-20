<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_path = public_path('word.sql');

        \DB::unprepared(
            file_get_contents($file_path)
        );
    }
}
