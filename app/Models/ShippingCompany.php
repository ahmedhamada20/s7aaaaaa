<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class ShippingCompany extends Model
{
    use HasFactory,SearchableTrait;

    protected $fillable = [
        'name',
        'code',
        'description',
        'fast',
        'cost',
        'status',
    ];


    protected $searchable = [

        'columns' => [
            'shipping_companies.name' => 10,
            'shipping_companies.code' => 10,
            'shipping_companies.description' => 10,
        ],
    ];


    public function fast()
    {
        return $this->fast ? 'Fast' : 'No Fast';
    }

    public function status()
    {
        return $this->status ? 'Active' : 'No Active';
    }

    public function shippingCompany() : BelongsToMany
    {
        return  $this->belongsToMany(Country::class,'shippingCompany_country','shipping_companies_id','country_id');
    }
}
