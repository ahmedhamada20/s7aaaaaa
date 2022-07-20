<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();

        $mainCategory = Category::create(['name' => "mainCategory", 'slug' => "mainCategory", 'cover' => null, 'status' => true, 'parent_id' => null,]);

        Category::create(['name' => "mainCategory", 'slug' => "ToCategory", 'cover' => null, 'status' => true, 'parent_id' => $mainCategory->id,]);

        Category::create(['name' => "mainCategory", 'slug' => "thereCategory", 'cover' => null, 'status' => true, 'parent_id' => $mainCategory->id,]);


        $ToCategory = Category::create(['name' => "mainCategory", 'slug' => "main_Category", 'cover' => null, 'status' => true, 'parent_id' => null,]);

        Category::create(['name' => "mainCategory", 'slug' => "To_Category", 'cover' => null, 'status' => true, 'parent_id' => $ToCategory->id,]);

        Category::create(['name' => "mainCategory", 'slug' => "there_Category", 'cover' => null, 'status' => true, 'parent_id' => $ToCategory->id,]);


        $thereCategory = Category::create(['name' => "mainCategory", 'slug' => "main_Category_one", 'cover' => null, 'status' => true, 'parent_id' => null,]);

        Category::create(['name' => "mainCategory", 'slug' => "To_Category_to", 'cover' => null, 'status' => true, 'parent_id' => $thereCategory->id,]);

        Category::create(['name' => "mainCategory", 'slug' => "there_Category_there", 'cover' => null, 'status' => true, 'parent_id' => $thereCategory->id,]);

        Schema::enableForeignKeyConstraints();
    }
}
