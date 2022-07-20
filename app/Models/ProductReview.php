<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductReview extends Model
{
    use HasFactory, SearchableTrait;

    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'email',
        'title',
        'massage',
        'status',
        'rating',
    ];
    protected $searchable = [

        'columns' => [
            'product_reviews.name' => 10,
            'product_reviews.email' => 10,
            'product_reviews.title' => 10,
            'product_reviews.massage' => 10,
        ],
    ];

    public function status()
    {
        return $this->status != false ? 'Active' : 'No Active';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
