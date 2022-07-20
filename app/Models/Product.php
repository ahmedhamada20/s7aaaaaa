<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    use SearchableTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'quantity',
        'category_id',
        'feature',
        'status',
    ];

    public function status()
    {
        return $this->status != false ? 'Active' : 'No Active';
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function scopeFeature($query)
    {
        return $query->whereFeature(true);
    }

    public function scopeStatus($query)
    {
        return $query->whereStatus(true);
    }

    public function scopeHasQuantity($query)
    {
        return $query->where('quantity','>', 0);
    }

    public function scopeActiveCategory($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
    }

    protected $searchable = [

        'columns' => [
            'products.name' => 10,
        ],
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categoryTage()
    {
        return $this->belongsToMany(Tag::class, 'tage_product', 'product_id', 'tag_id');
    }

}
