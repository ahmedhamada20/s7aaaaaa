<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;


class AdminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $faker = Factory::create();

        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        $adminRole = Role::create(['name' => 'admin','display_name' => 'Admin', 'description' => 'admin', 'allowed_route' => 'admin']);
        $supervisorRole = Role::create(['name' => 'supervisor', 'display_name' => 'supervisor', 'description' => 'supervisor', 'allowed_route' => 'supervisor']);
        $customerRole = Role::create(['name' => 'customer', 'display_name' => 'customer', 'description' => 'customer', 'allowed_route' => null]);

        $admin = User::create(['first_name' => 'Ahmed', 'type' => 'admin', 'last_name' => 'Hamada', 'username' => 'Admin', 'email' => 'admin@admin.com', 'phone' => '0121212121', 'status' => 1, 'password' => Hash::make(123456789),]);

        $admin->attachRole($adminRole);


        $supervisor = User::create(['first_name' => 'supervisor', 'type' => 'supervisor', 'last_name' => 'supervisor', 'username' => 'supervisor', 'email' => 'supervisor@supervisor.com', 'phone' => '021212121', 'status' => 1, 'password' => Hash::make(123456789),]);

        $supervisor->attachRole($supervisorRole);

        for ($i = 0; $i <= 20; $i++) {
            $customer = User::create(['first_name' => $faker->firstName, 'type' => 'customer', 'username' => $faker->unique()->userName, 'last_name' => $faker->lastName, 'email' => $faker->unique()->safeEmail, 'phone' => 0112121 . $faker->unique()->numberBetween(1000, 2000), 'status' => 1, 'password' => Hash::make(123456789),]);

            $customer->attachRole($customerRole);
        }


        $mangeMain = Permission::create(['name' => 'main', 'display_name' => 'Main', 'description' => 'dashboard', 'route' => 'dashboard', 'module' => 'dashboard', 'as' => 'dashboard', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1',]);
        $mangeMain->parent_show = $mangeMain->id;
        $mangeMain->save();


        $mangeCategory = Permission::create(['name' => 'mange_category', 'display_name' => 'mange_category', 'description' => 'mange_category', 'route' => 'category', 'module' => 'category', 'as' => 'category.index', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $mangeCategory->parent_show = $mangeCategory->id;
        $mangeCategory->save();


        $showCategory = Permission::create(['name' => 'show_category', 'display_name' => 'show_category', 'description' => 'show_category', 'route' => 'category', 'module' => 'category', 'as' => 'category.index', 'parent' => $mangeCategory->id, 'parent_original' => $mangeCategory->id, 'parent_show' => $mangeCategory->id, 'sidebar_link' => '1', 'appear' => '1',]);

        $addCategory = Permission::create(['name' => 'add_category', 'display_name' => 'add_category', 'description' => 'add_category', 'route' => 'category', 'module' => 'category', 'as' => 'category.create', 'parent' => $mangeCategory->id, 'parent_original' => $mangeCategory->id, 'parent_show' => $mangeCategory->id, 'sidebar_link' => '1', 'appear' => '0',]);

        $displayCategory = Permission::create(['name' => 'display_category', 'display_name' => 'display_category', 'description' => 'display_category', 'route' => 'category', 'module' => 'category', 'as' => 'category.show', 'parent' => $mangeCategory->id, 'parent_original' => $mangeCategory->id, 'parent_show' => $mangeCategory->id, 'sidebar_link' => '1', 'appear' => '0',]);

        $updateCategory = Permission::create(['name' => 'update_category', 'display_name' => 'update_category', 'description' => 'update_category', 'route' => 'category', 'module' => 'category', 'as' => 'category.edit', 'parent' => $mangeCategory->id, 'parent_original' => $mangeCategory->id, 'parent_show' => $mangeCategory->id, 'sidebar_link' => '1', 'appear' => '0',]);

        $destroyCategory = Permission::create(['name' => 'destroy_category', 'display_name' => 'destroy_category', 'description' => 'destroy_category', 'route' => 'category', 'module' => 'category', 'as' => 'category.destroy', 'parent' => $mangeCategory->id, 'parent_original' => $mangeCategory->id, 'parent_show' => $mangeCategory->id, 'sidebar_link' => '1', 'appear' => '0',]);
        Schema::enableForeignKeyConstraints();

    }
}
