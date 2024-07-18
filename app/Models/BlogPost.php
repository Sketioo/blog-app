<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['title', 'content', 'user_id'] ;

    // public function toSearchableArray(): array
    // {
    //     return [
    //         'title' => $this->title,
    //         'content' => $this->content,
    //     ];
    // }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
