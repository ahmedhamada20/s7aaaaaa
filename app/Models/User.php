<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use EntrustUserWithPermissionsTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use SearchableTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'status',
        'image',
        'type',
    ];

    protected $appends = ['full_name'];

    
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name) != null ? ucfirst($this->first_name) . ' ' . ucfirst($this->last_name) : $this->first_name;
    }


    protected $searchable = [

        'columns' => [
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.username' => 10,
            'users.email' => 10,
        ],
    ];


  


    public function address()
    {
        return $this->hasMany(UserAddress::class,'user_id');
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function status()
    {
        return $this->status  ?'active' : 'No Active';
    }


  

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function CheckRoleUser()
    {
        return $this->roles();
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
