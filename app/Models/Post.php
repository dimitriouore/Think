<?php

namespace App\Models;

use App\Models\users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {   
        return $this->belongsTo(users::class);
    }

}