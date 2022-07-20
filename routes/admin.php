<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCouponController;
use App\Http\Controllers\Admin\ProductRewiewController;
use App\Http\Controllers\Admin\ShippingCompanyController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Admin\TagesController;
use App\Http\Controllers\Admin\UserAddressController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('admins')->as('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::post('category_remove_image/remove-image', [CategoryController::class, 'category_remove_image'])->name('category_remove_image');

    Route::resource('product', ProductController::class);
    Route::post('product_remove_image/remove-image', [ProductController::class, 'product_remove_image'])->name('product_remove_image');

    Route::resource('tage', TagesController::class);

    Route::resource('productCoupon', ProductCouponController::class);

    Route::resource('productReview', ProductRewiewController::class);

    Route::resource('customer', CustomerController::class);
    Route::post('customer_remove_image', [CustomerController::class,'customer_remove_image'])->name('customer_remove_image');

    Route::resource('supervisor', SupervisorController::class);
    Route::post('supervisor_remove_image', [SupervisorController::class,'supervisor_remove_image'])->name('supervisor_remove_image');

    Route::resource('country', CountyController::class);

    Route::resource('state', StateController::class);

    Route::resource('city', CityController::class);

    Route::resource('userAddress', UserAddressController::class);

    Route::resource('shippingCompany', ShippingCompanyController::class);

});
