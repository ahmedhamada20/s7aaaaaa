<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AdminLoginSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductCouponSeeder::class);
        $this->call(ProductReviewSeeder::class);
        $this->call(WordSeeder::class);
        $this->call(WordChangeStatusSeeder::class);
        $this->call(UserAddressSeeder::class);
        $this->call(ShippingCompanySeeder::class);
    }
}
