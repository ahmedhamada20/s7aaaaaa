<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TagSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();
        Schema::disableForeignKeyConstraints();

        DB::table('tags')->truncate();

        for ($i = 0; $i <= 500; $i++) {

            $tage[] = [
                'name' => $faker->name,
                'slug' => $faker->unique()->name,
                'status' => true,
            ];
        }

        $chunks = array_chunk($tage, 100);

        foreach ($chunks as $chunk) {
            Tag::insert($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
