<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCoupon extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $searchable = [

        'columns' => [
            'product_coupons.code' => 10,
            'product_coupons.description' => 10,
        ],
    ];

    protected $fillable = [
        'code',
        'type',
        'start_data',
        'end_data',
        'description',
        'use_coupon',
        'used_coupon',
        'value',
        'couponsUsed',
        'status',
    ];

    public function status()
    {
        return $this->status != false ? 'Acrive' : 'No Active';
    }

    protected $dates = ['start_data', 'end_data'];
}
