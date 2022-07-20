<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class State extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $fillable = [
        'name',
        'country_id',
        'status',
    ];


    protected $searchable = [

        'columns' => [
            'states.name' => 10,
        ],
    ];

    public function citys()
    {
        return $this->hasMany(City::class, 'state_id');
    }

    public function status()
    {
        return $this->status  ? 'Active' : 'NO Active';
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
