<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type');
            $table->dateTime('start_data')->nullable();
            $table->dateTime('end_data')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('use_coupon')->nullable();
            $table->unsignedBigInteger('used_coupon')->default(0);
            $table->unsignedBigInteger('value')->nullable();
            $table->unsignedBigInteger('couponsUsed')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('product_coupons');
    }
}
