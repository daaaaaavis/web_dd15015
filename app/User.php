<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // "Setter" - does stuff when setting value to database
    public function setNameAttribute($value){
        $this->attributes['name'] = ucfirst($value);
    }

    // "Getter" - does stuff when getting value from database
    public function getNameAttribute($value){
        return "User: " . $value;
    }

}
