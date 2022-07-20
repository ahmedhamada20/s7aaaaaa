<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];
    use SearchableTrait;

    protected $searchable = [

        'columns' => [
            'countries.name' => 10,
        ],
    ];


    public function states()
    {
        return $this->hasMany(State::class, 'country_id');
    }

    public function status()
    {
        return $this->status ? 'Active' : 'NO Active';
    }

    public function shippingCompany(): BelongsToMany
    {
        return $this->belongsToMany(ShippingCompany::class, 'shippingCompany_country', 'country_id', 'shipping_companies_id');
    }

}
