<?php

namespace App;

class Tag extends Model
{
    public function Posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
