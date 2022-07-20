<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SearchableTrait;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [

        'columns' => [
            'categories.name' => 10,
        ],
    ];

    protected $fillable = [
        'name',
        'slug',
        'cover',
        'status',
        'parent_id',
    ];

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}
