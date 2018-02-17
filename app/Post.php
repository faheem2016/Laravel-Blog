<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body, $user_id)
    {
        $this->comments()->create(['body' => $body, 'user_id' => $user_id]);
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['month']) && $month = $filters['month']){
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if (isset($filters['year']) && $year = $filters['year']){
            $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
        return static::selectRaw('YEAR(created_at) year, MONTHNAME(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class);
    }
}
