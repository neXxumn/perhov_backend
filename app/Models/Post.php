<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'tag', 'image'];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function tags () {
        return $this->belongsToMany(Tag::class);
    }
}
