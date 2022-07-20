<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
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

        DB::table('products')->truncate();

        for ($i = 0; $i <= 10; $i++) {
            $product[] = [
                'name' => $faker->name,
                'slug' => $faker->unique()->name,
                'description' => $faker->paragraph,
                'price' => $faker->numberBetween(1000, 2000),
                'quantity' => $faker->numberBetween(1000, 2000),
                'category_id' => $faker->randomElement(Category::where('status', true)->pluck('id')),
                'feature' => true,
                'status' => true,
            ];
        }

        $chunks = array_chunk($product, 10);

        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }

        $tags = Tag::where('status', true)->get();

        Product::all()->each(function ($product) use ($tags) {
            $product->categoryTage()->attach($tags->random(rand(1, 4))->pluck('id')->toArray());
        });

        Schema::enableForeignKeyConstraints();
    }
}
