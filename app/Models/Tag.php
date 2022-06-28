<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    protected $fillable = ['tag'];

    public function posts () {
        return $this->belongsToMany(Post::class);
    }
}
