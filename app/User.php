<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname' , 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function relations()
    {
        return $this->hasMany('App\Relation');
    }

}
