<?php

namespace App\Models;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    //* The naming of 
    public function blogPost(){
        return $this->belongsTo(BlogPost::class);
    }
}
