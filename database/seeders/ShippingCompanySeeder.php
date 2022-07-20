<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingCompany;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShippingCompanySeeder extends Seeder
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

        DB::table('shipping_companies')->truncate();

        for ($i = 0; $i < 500; $i++) {
            $shipping[] = [
                'name' => $faker->name,
                'code' => rand(1,500),
                'description' => $faker->title,
                'fast' => $faker->randomElement([true,false]),
                'cost' => $faker->randomElement(['100','200','300','400']),
                'status' => $faker->randomElement([true,false]),
            ];
        }

        $chunks = array_chunk($shipping, 100);

        foreach ($chunks as $chunk) {
            ShippingCompany::insert($chunk);
        }

        $country = Country::whereStatus(true)->get();

        ShippingCompany::all()->each(function ($shippingCompany) use ($country) {
            $shippingCompany->shippingCompany()->attach($country->random(rand(1, 4))->pluck('id')->toArray());
        });


        Schema::enableForeignKeyConstraints();
    }
}
