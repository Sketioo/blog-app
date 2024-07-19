<?php

namespace App\Models;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'blog_post_id',
        'content',
        'parent_comment_id'
    ];

    //* The naming of 
    public function blogPost(){
        return $this->belongsTo(BlogPost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')->orderBy('created_at', 'asc');
    }
}

