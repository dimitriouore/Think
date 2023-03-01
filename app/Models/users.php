<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;
use Cartalyst\Sentinel\Hashing\BcryptHasher;

class users extends EloquentUser
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function getHasher()
    {
        return new BcryptHasher;
    }
}
