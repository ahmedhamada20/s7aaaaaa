<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;
    use SearchableTrait;


    protected $searchable = [

        'columns' => [
            'tags.name' => 10,
        ],
    ];

    public function status()
    {
        return $this->status != true ? 'No Active' : 'Active';
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function categoryTage()
    {
        return $this->belongsToMany(Product::class, 'tage_product', 'tag_id', 'product_id');
    }
}
