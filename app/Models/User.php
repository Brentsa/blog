<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var string[]
    //  */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'username'
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        //A user has many posts
        return $this->hasMany(Post::class);
    }

    //attribute mutator function that hashes password before saving to database
    public function setPasswordAttribute($password){
      return $this->attributes['password'] = bcrypt($password);  
    }

    // accessor that mutates a value when getting it from the user
    // public function getUsernameAttribute($username){
    //     return ucfirst($username);
    // }
}
