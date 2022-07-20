<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('address_title')->default('Main');
            $table->boolean('default_address')->default(false);
            $table->foreignId('country_id')->nullable()->constrained('countries')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('citi_id')->nullable()->constrained('cities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('first_name')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('po_box')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
