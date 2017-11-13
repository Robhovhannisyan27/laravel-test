<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $fillable = [
        'name', 
        'email',
        'password', 
        'confirm_token',
        'facebook_id'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }
}
