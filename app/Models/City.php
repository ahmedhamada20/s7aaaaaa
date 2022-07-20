<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class City extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $fillable = [
        'name',
        'state_id',
        'status',
    ];


    protected $searchable = [

        'columns' => [
            'cities.name' => 10,
        ],
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function status()
    {
        return $this->status != false ? 'Active' : 'NO Active';
    }

}
