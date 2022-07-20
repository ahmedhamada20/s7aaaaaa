<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\UserAddress;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = collect(User::all()->modelKeys());
        $countrys = collect(Country::all()->modelKeys());
        $states = collect(State::all()->modelKeys());
        $citiys = collect(City::all()->modelKeys());

        Schema::disableForeignKeyConstraints();

        DB::table('user_addresses')->truncate();

        for ($i = 0; $i < 5000; $i++) {

            $address[] = [
                'user_id' => $users->random(),
                'address_title' => $faker->title,
                'default_address' => $faker->randomElement([true,false]),
                'country_id' => $countrys->random(),
                'state_id' => $states->random(),
                'citi_id' => $citiys->random(),
                'first_name' => $faker->name,
                'address' => $faker->address,
                'address2' => $faker->address,
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'phone' => $faker->numberBetween(011111111,012121212122),
                'zip_code' => $faker->numberBetween(20,500),
                'po_box' => $faker->numberBetween(50,200),
            ];
        }

        $chunks = array_chunk($address, 1000);

        foreach ($chunks as $chunk) {
            UserAddress::insert($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
