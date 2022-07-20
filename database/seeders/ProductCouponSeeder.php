<?php

namespace Database\Seeders;

use App\Models\ProductCoupon;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductCouponSeeder extends Seeder
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
        DB::table('product_coupons')->truncate();

        for ($i = 0; $i <= 20; $i++) {
            ProductCoupon::create([
                'code' => $faker->unique()->postcode,
                'type' => $faker->randomElement(['fixed', 'cash']),
                'start_data' => Carbon::now(),
                'end_data' =>Carbon::now()->addMonth(),
                'description' => $faker->text,
                'use_coupon' => $faker->randomElement([10, 20, 30, 40]),
                'value' => $faker->numberBetween(200, 400),
                'couponsUsed' =>$faker->numberBetween(1, 20) ,
                'status' => true,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
