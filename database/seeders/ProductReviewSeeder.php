<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductReviewSeeder extends Seeder
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
        DB::table('product_reviews')->truncate();

        Product::all()->each(function ($product) use ($faker) {
            for ($i = 1; $i < rand(1, 3); $i++) {
                $product->reviews()->create([
                    'user_id' => $faker->randomElement(User::whereType('customer')->pluck('id')),
                    'name' => $faker->userName,
                    'email' => $faker->safeEmail,
                    'title' => $faker->title,
                    'massage' => $faker->paragraph,
                    'status' => $faker->randomElement([true, false]),
                    'rating' => $faker->randomElement(['1', '2', '3', '4', '5']),
                ]);
            }
        });

        Schema::enableForeignKeyConstraints();
    }
}
